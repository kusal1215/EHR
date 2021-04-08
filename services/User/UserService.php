<?php

namespace services\User;

use App\User;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function get($id)
    {
        return $this->user->find($id);
    }

    public function getByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function getPatients()
    {
        return $this->user->where('user_level', 3)->orderBy('name', 'desc')->get();
    }

    public function getDoctors()
    {
        return $this->user->where('user_level', 2)->orderBy('name', 'desc')->get();
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    /**
     * update
     *
     * @param  mixed $user
     * @param  mixed $data
     * @return void
     */
    public function update(User $user, array $data)
    {
        return $user->update($this->edit($user, $data));
    }

    /**
     * edit
     *
     * @param  mixed $user
     * @param  mixed $data
     */
    protected function edit(User $user, $data)
    {
        return array_merge($user->toArray(), $data);
    }

    public function delete($id)
    {
        $user = $this->get($id);
        return $user->delete();
    }

    public function addDoctor($request)
    {
        $data = $request->all();

        if ($request->hasFile('user_image')) {
            $file = $request->file('user_image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/doctorsProfile', $filename);
            $data['user_image'] = $filename;
        } else {
            $data['user_image'] = '';
        }

        $this->create($data);
    }

    public function updateDoctor($id, $data)
    {
        $doctor = $this->get($id);

        if ($doctor) {
            $this->update($doctor, $data);
        }
    }
}
