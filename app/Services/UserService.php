<?php
namespace App\Services;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repository\UserRepository;
use Bpjs\Framework\Helpers\Hash;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Session;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;

class UserService
{
    public function __construct(protected UserRepository $userrepo){}
    public function register(array $data): User
    {
        Validator::make($data, [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function login(string $username, string $password): ?User
    {
        $user = User::query()->where('username', $username)->first();
        if ($user && Hash::verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function getData($data)
    {
        $result = $this->userrepo->getUserById($data);
        if(!$result){
            return vd([
                'status' => 404,
                'message' => 'data not found',
            ]);
        }
        return UserDTO::getUserDTO($result);
    }

    public function createUser(array $data)
    {
        $validate = $this->validate($data);
        if($validate){
            return [
                'success' => false,
                'status' => 422,
                'message' => $validate
            ];
        }
        if($this->isUsernameIsExsist($data['username'])){
            return [
                'success' => false,
                'status' => 400,
                'message' => 'username already exist'
            ];
        }

        $user = $this->userrepo->createUser($data);

        return [
            'success' => true,
            'status' => 200,
            'data' => $user
        ];
    }

    public function updateUser($id, array $data)
    {
        $attributes = [
            'username' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'section' => $data['section'],
            'role' => $data['role'],
        ];
        if(!empty($data['password'])){
            $attributes['password'] = Hash::make($data['password']);
        }
        $user = $this->userrepo->updateUser($attributes);
        return [
            'success' => true,
            'status' => 200,
            'data' => $user
        ];
    }

    public function deleteUser($id)
    {
        $user = $this->userrepo->deleteUser($id);
        return [
            'success' => true,
            'status' => 200,
            'data' => $user,
        ];
    }

    private function validate(array $data)
    {
        $validate = Validator::make($data,
        [
            'username' => 'required|numeric|min:5',
            'password' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'section' => 'required',
            'role' => 'required',
        ],
        [
            'username.required' => 'Username is required',
            'username.numeric' => 'Username must be numeric',
            'username.min' => 'Username minimum 5 characters',
            'password.required' => 'Password is required',
            'name.required' => 'Name is required',
            'name.min' => 'Name minimum 3 characters',
            'email.required' => 'Email is required',
            'section.required' => 'Section is required',
            'role.required' => 'Role is required'
        ]
        );
        return $validate;
    }

    private function isUsernameIsExsist($param)
    {
        $user = User::query()->where('username','=',$param)->first();
        return $user ? true : false;
    }
}
