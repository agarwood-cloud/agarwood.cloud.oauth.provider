<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\Facade;

use Agarwood\Core\Support\Impl\AbstractBaseController;
use App\Authentication\Application\OAuthApplication;
use App\Authentication\Interfaces\Assembler\LoginAssembler;
use App\Authentication\Interfaces\DTO\LoginDTO;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Annotation\Mapping\ValidateType;

/**
 * @Controller(prefix="/authentication/oauth")
 */
class OAuthController extends AbstractBaseController
{
    /**
     * 应用层
     *
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var OAuthApplication
     */
    protected OAuthApplication $application;

    /**
     * 用户登录
     *
     * @RequestMapping(route="user/login", method={ RequestMethod::POST })
     * @Validate(validator=LoginDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request $request
     *
     * @return Response|null
     */
    public function actionUserLogin(Request $request): ?Response
    {
        $DTO = LoginAssembler::attributesToLoginDTO($request->getParsedBody());
        return $this->wrapper()->setData(
            $this->application->userLoginProvider($DTO)
        )->response();
    }

    /**
     * 创建用户
     *
     * @RequestMapping(route="user/signup", method={ RequestMethod::POST })
     * @Validate(validator=LoginDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request  $request
     * @param \Swoft\Http\Message\Response $response
     *
     * @return Response|null
     */
    public function actionUserSignup(Request $request, Response $response): ?Response
    {
        $DTO = LoginAssembler::attributesToSignupDTO($request->getParsedBody());
        return $this->wrapper()->setData([
            'result' => $this->application->userSignupProvider($DTO)
        ])->response($response->withStatus(201));
    }

    /**
     * 退出登陆
     *
     * @RequestMapping(route="user/logout", method={ RequestMethod::POST })
     *
     * @return Response|null
     */
    public function actionUserLogout(): ?Response
    {
        return $this->wrapper()->setData([
            'result' => $this->application->userLogoutProvider()
        ])->response();
    }
}
