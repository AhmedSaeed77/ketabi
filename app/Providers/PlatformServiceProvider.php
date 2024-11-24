<?php

namespace App\Providers;

use App\Http\Services\Api\V1\Auth\AuthMobileService;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Http\Services\Api\V1\Auth\AuthWebService;
use App\Http\Services\Api\V1\Cart\CartMobileService;
use App\Http\Services\Api\V1\Cart\CartService;
use App\Http\Services\Api\V1\Cart\CartWebService;
use App\Http\Services\Api\V1\Chat\ChatMobileService;
use App\Http\Services\Api\V1\Chat\ChatService;
use App\Http\Services\Api\V1\Chat\ChatWebService;
use App\Http\Services\Api\V1\EducationalStage\EducationalStageMobileService;
use App\Http\Services\Api\V1\EducationalStage\EducationalStageService;
use App\Http\Services\Api\V1\EducationalStage\EducationalStageWebService;
use App\Http\Services\Api\V1\Learnable\LearnableMobileService;
use App\Http\Services\Api\V1\Learnable\LearnableService;
use App\Http\Services\Api\V1\Learnable\LearnableWebService;
use App\Http\Services\Api\V1\Learnable\Student\LearnableStudentMobileService;
use App\Http\Services\Api\V1\Learnable\Student\LearnableStudentService;
use App\Http\Services\Api\V1\Learnable\Student\LearnableStudentWebService;
use App\Http\Services\Api\V1\Learnable\Teacher\LearnableTeacherMobileService;
use App\Http\Services\Api\V1\Learnable\Teacher\LearnableTeacherService;
use App\Http\Services\Api\V1\Learnable\Teacher\LearnableTeacherWebService;
use App\Http\Services\Api\V1\Manager\ManagerMobileService;
use App\Http\Services\Api\V1\Manager\ManagerService;
use App\Http\Services\Api\V1\Manager\ManagerWebService;
use App\Http\Services\Api\V1\Payment\PaymentMobileService;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Http\Services\Api\V1\Payment\PaymentWebService;
use App\Http\Services\Api\V1\Role\RoleMobileService;
use App\Http\Services\Api\V1\Role\RoleService;
use App\Http\Services\Api\V1\Role\RoleWebService;
use App\Http\Services\Api\V1\Structure\StructureMobileService;
use App\Http\Services\Api\V1\Structure\StructureService;
use App\Http\Services\Api\V1\Structure\StructureWebService;
use App\Http\Services\Api\V1\Subject\SubjectMobileService;
use App\Http\Services\Api\V1\Subject\SubjectService;
use App\Http\Services\Api\V1\Subject\SubjectWebService;
use App\Http\Services\Api\V1\User\UserMobileService;
use App\Http\Services\Api\V1\User\UserService;
use App\Http\Services\Api\V1\User\UserWebService;
use App\Http\Services\Api\V1\Wallet\WalletMobileService;
use App\Http\Services\Api\V1\Wallet\WalletService;
use App\Http\Services\Api\V1\Wallet\WalletWebService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
    private const VERSIONS = [
        1,
    ];
    private const PLATFORMS = [
        'w',
        'm',
    ];
    private const SERVICES = [
//   Version => Services
        1 => [
            StructureService::class => [
                'w' => StructureWebService::class,
                'm' => StructureMobileService::class
            ],
            AuthService::class => [
                'w' => AuthWebService::class,
                'm' => AuthMobileService::class
            ],
            EducationalStageService::class => [
                'w' => EducationalStageWebService::class,
                'm' => EducationalStageMobileService::class
            ],
            SubjectService::class => [
                'w' => SubjectWebService::class,
                'm' => SubjectMobileService::class
            ],
            ManagerService::class => [
                'w' => ManagerWebService::class,
                'm' => ManagerMobileService::class
            ],
            RoleService::class => [
                'w' => RoleWebService::class,
                'm' => RoleMobileService::class
            ],
            LearnableService::class => [
                'w' => LearnableWebService::class,
                'm' => LearnableMobileService::class
            ],
            LearnableTeacherService::class => [
                'w' => LearnableTeacherWebService::class,
                'm' => LearnableTeacherMobileService::class
            ],
            LearnableStudentService::class => [
                'w' => LearnableStudentWebService::class,
                'm' => LearnableStudentMobileService::class
            ],
            UserService::class => [
                'w' => UserWebService::class,
                'm' => UserMobileService::class
            ],
            CartService::class => [
                'w' => CartWebService::class,
                'm' => CartMobileService::class
            ],
            PaymentService::class => [
                'w' => PaymentWebService::class,
                'm' => PaymentMobileService::class
            ],
            WalletService::class => [
                'w' => WalletWebService::class,
                'm' => WalletMobileService::class
            ],
            ChatService::class => [
                'w' => ChatWebService::class,
                'm' => ChatMobileService::class
            ],
        ],
    ];
    private ?int $version = null;
    private ?string $platform = null;

    public function __construct($app)
    {
        parent::__construct($app);
        foreach (self::VERSIONS as $version) {
            foreach (self::PLATFORMS as $platform) {
                $pattern = app()->environment(['production']) ? 'v' . $version . '/' . $platform . '/*' : 'api/v' . $version . '/' . $platform . '/*';
                if (request()->is($pattern)) {
                    $this->version = $version;
                    $this->platform = $platform;
                }
            }
        }
    }

    private function initiate(): void
    {
        foreach (self::SERVICES[$this->version] ?? [] as $abstractService => $targetService) {
            $this->app->singleton($abstractService, $targetService[$this->platform]);
        }
    }

    public function register(): void
    {
        $this->initiate();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
