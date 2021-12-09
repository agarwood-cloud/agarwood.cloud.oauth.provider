<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Interfaces\Facade;

use Agarwood\Core\Support\Impl\AbstractBaseController;
use App\Authorization\Interfaces\Assembler\OAuthAssembler;
use App\Authorization\Interfaces\DTO\PermissionDTO;
use App\Authorization\Interfaces\DTO\RoleDTO;
use App\Authorization\Interfaces\DTO\UserDTO;
use App\Authorization\Interfaces\DTO\UserPermissionDTO;
use App\Authorization\Interfaces\DTO\UserPermissionsDTO;
use App\Authorization\Interfaces\DTO\UserRoleDTO;
use App\Authorization\Application\RBACApplication;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Annotation\Mapping\ValidateType;

/**
 * @Controller(prefix="/authorization/oauth")
 */
class OAuthController extends AbstractBaseController
{
    /**
     * 应用层
     *
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var RBACApplication
     */
    protected RBACApplication $application;

    /**
     * 获取用户具有的角色
     *
     * @RequestMapping(route="get-roles-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionGetRolesForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getQueryParams());
        return $this->wrapper()->setData(
            $this->application->getRolesForUserProvider($DTO->getUser())
        )->response();
    }

    /**
     * 获取具有角色的用户
     *
     * @RequestMapping(route="get-users-for-role", method={ RequestMethod::GET })
     * @Validate(validator=RoleDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionGetUsersForRole(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToRoleDTO($request->getQueryParams());
        return $this->wrapper()->setData(
            $this->application->getRolesForUserProvider($DTO->getRole())
        )->response();
    }

    /**
     * 确定用户是否具有角色
     *
     * @RequestMapping(route="has-role-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserRoleDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionHasRoleForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserRoleDTO($request->getQueryParams());
        return $this->wrapper()->setData([
            'result' => $this->application->hasRoleForUserProvider($DTO->getUser(), $DTO->getRole())
        ])->response();
    }

    /**
     * 为用户添加角色。 如果用户已经拥有该角色（aka不受影响），则返回false
     *
     * @RequestMapping(route="add-role-for-user", method={ RequestMethod::POST })
     * @Validate(validator=UserRoleDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionAddRoleForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserRoleDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->addRoleForUserProvider($DTO->getUser(), $DTO->getRole())
        ])->response();
    }

    /**
     * 删除用户的角色。 如果用户没有该角色，则返回false(不会产生影响)
     *
     * @RequestMapping(route="delete-role-for-user", method={ RequestMethod::DELETE })
     * @Validate(validator=UserRoleDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeleteRoleForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserRoleDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deleteRoleForUserProvider($DTO->getUser(), $DTO->getRole())
        ])->response();
    }

    /**
     * 删除用户的所有角色。 如果用户没有任何角色，则返回false (不会受到影响)
     *
     * @RequestMapping(route="delete-roles-for-user", method={ RequestMethod::DELETE })
     * @Validate(validator=UserDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeleteRolesForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deleteRolesForUserProvider($DTO->getUser())
        ])->response();
    }

    /**
     * 删除一个用户。 如果用户不存在，则返回false（也就是说不受影响）。
     *
     * @RequestMapping(route="delete-user", method={ RequestMethod::DELETE })
     * @Validate(validator=UserDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeleteUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deleteUserProvider($DTO->getUser())
        ])->response();
    }

    /**
     * 删除一个角色。
     *
     * @RequestMapping(route="delete-role", method={ RequestMethod::DELETE })
     * @Validate(validator=RoleDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeleteRole(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToRoleDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deleteRoleProvider($DTO->getRole())
        ])->response();
    }

    /**
     * 删除权限。 如果权限不存在，则返回false（也就是说不受影响）
     *
     * @RequestMapping(route="delete-permission", method={ RequestMethod::DELETE })
     * @Validate(validator=PermissionDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeletePermission(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToPermissionDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deletePermissionProvider($DTO->getPermission())
        ])->response();
    }

    /**
     * 为用户或角色添加权限。 如果用户或角色已经拥有该权限（也就是不受影响），则返回false
     *
     * @RequestMapping(route="add-permission-for-user", method={ RequestMethod::POST })
     * @Validate(validator=UserPermissionDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionAddPermissionForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserPermissionDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->addPermissionForUserProvider($DTO->getUser(), $DTO->getPermission())
        ])->response();
    }

    /**
     * 为用户或角色添加多个权限。 如果用户或角色已经有一个权限，则返回 false (不会受影响)。
     *
     * @RequestMapping(route="add-permissions-for-user", method={ RequestMethod::POST })
     * @Validate(validator=UserPermissionsDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionAddPermissionsForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserPermissionsDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->addPermissionsForUserProvider($DTO->getUser(), $DTO->getPermissions())
        ])->response();
    }

    /**
     * 删除用户或角色的权限。 如果用户或角色没有权限则返回 false(不会受影响)。
     *
     * @RequestMapping(route="delete-permission-for-user", method={ RequestMethod::DELETE })
     * @Validate(validator=UserPermissionsDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeletePermissionForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserPermissionDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deletePermissionForUserProvider($DTO->getUser(), $DTO->getPermission())
        ])->response();
    }

    /**
     * 删除用户或角色的权限。 如果用户或角色没有任何权限（也就是不受影响），则返回false
     *
     * @RequestMapping(route="delete-permissions-for-user", method={ RequestMethod::DELETE })
     * @Validate(validator=UserDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionDeletePermissionsForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->deletePermissionsForUserProvider($DTO->getUser())
        ])->response();
    }

    /**
     * 获取用户或角色的权限。
     *
     * @RequestMapping(route="get-permissions-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionGetPermissionsForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getQueryParams());
        return $this->wrapper()->setData(
            $this->application->getPermissionsForUserProvider($DTO->getUser())
        )->response();
    }

    /**
     * 确定用户是否具有权限。
     *
     * @RequestMapping(route="has-permission-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserPermissionDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionHasPermissionForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserPermissionDTO($request->getQueryParams());
        return $this->wrapper()->setData([
            'result' => $this->application->hasPermissionForUserProvider($DTO->getUser(), $DTO->getPermission())
        ])->response();
    }

    /**
     * 获取用户具有的隐式角色。 与GetRolesForUser() 相比，该函数除了直接角色外还检索间接角色。
     *
     * @RequestMapping(route="get-implicit-role-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionGetImplicitRolesForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getQueryParams());
        return $this->wrapper()->setData(
            $this->application->getImplicitRolesForUserProvider($DTO->getUser())
        )->response();
    }

    /**
     * GetImplicitPermissionsForUser 获得用户或角色的隐含权限。与GetPermissionsForUser() 相比，此函数获取继承角色的权限。
     *
     * @RequestMapping(route="get-implicit-permissions-for-user", method={ RequestMethod::GET })
     * @Validate(validator=UserDTO::class, type=ValidateType::GET)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionGetImplicitPermissionsForUser(Request $request): ?Response
    {
        $DTO = OAuthAssembler::attributesToUserDTO($request->getQueryParams());
        return $this->wrapper()->setData(
            $this->application->getImplicitPermissionsForUserProvider($DTO->getUser())
        )->response();
    }
}
