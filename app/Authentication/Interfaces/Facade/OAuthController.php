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
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Application\OAuthApplication
     */
    public OAuthApplication $application;

    /**
     * User Login
     *
     * @RequestMapping(route="user-login", method={ RequestMethod::POST })
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
     * Create Admin User
     *
     * @RequestMapping(route="user-signup", method={ RequestMethod::POST })
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
     * Logout
     *
     * @RequestMapping(route="user-logout", method={ RequestMethod::POST })
     *
     * @return Response|null
     */
    public function actionUserLogout(): ?Response
    {
        return $this->wrapper()->setData([
            'result' => $this->application->userLogoutProvider()
        ])->response();
    }

    /**
     * Customer Service Login
     *
     * @RequestMapping(route="customer-login", method={ RequestMethod::POST })
     * @Validate(validator=LoginDTO::class, type=ValidateType::BODY)
     * @param \Swoft\Http\Message\Request  $request
     * @param \Swoft\Http\Message\Response $response
     *
     * @return Response|null
     */
    public function actionCustomerSignup(Request $request, Response $response): ?Response
    {
        $DTO = LoginAssembler::attributesToSignupDTO($request->getParsedBody());

        return $this->wrapper()->setData(
            $this->application->customerSignupProvider($DTO)
        )->response();
    }
}
