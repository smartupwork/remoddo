<?php


namespace App\Repository;

use App\DTO\Admin\User\UserUpdateDTO;
use App\DTO\DTOInterface;
use App\DTO\Security\RegistrationDTO;
use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository implements RepositoryInterface
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function list()
    {
        // TODO: Implement list() method.
    }

    public function findBy(array $condition)
    {
        return $this->user->where($condition)->first();
    }

    /**
     * @param RegistrationDTO $dto
     */
    public function save(DTOInterface $dto)
    {
        try {
            DB::beginTransaction();
            $password = Hash::make($dto->getPassword());

            /**
             * @var User $user
             */
            $this->user->setEmail($dto->getEmail())
                ->setPassword($password)
                ->setTimeZone(get_local_time())
                ->save();

            $avatar = null;

            if ($dto->getAvatar()) {
                $avatar = Storage::disk('user')->put('', $dto->getAvatar());
            }

            $this->user->info()->create([
                'name' => $dto->getName(),
                'surname' => $dto->getSurname(),
                'avatar' => $avatar
            ]);

            $roles = Role::whereIn('name', [UserType::LENDER, UserType::RENTER])->get();
            foreach ($roles as $role) {
                $this->user->roles()->attach($role->id);
            }


            DB::commit();
            event(new Registered($this->user));
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

    /**
     * @param UserUpdateDTO $dto
     * @param User $model
     */
    public function updateInfoInAdmin(DTOInterface $dto, Model $model)
    {
        if ($dto->getEmail()) {
            $model->setEmail($dto->getEmail());
        }

        if ($dto->getAddress()) {
            $model->info->update(['address' => $dto->getAddress()]);
        }
        $model->update();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }
}
