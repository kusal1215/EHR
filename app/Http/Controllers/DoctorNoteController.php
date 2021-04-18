<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\NoteHelper;
use services\ModalHelper\UserHelper;

class DoctorNoteController extends Controller
{
    public function all()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('doctor.notes.all')->with($response);
    }

    public function add()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

        return view('doctor.notes.add')->with($response);
    }

    public function save(Request $request)
    {
        NoteHelper::saveNote($request->all(), Auth::user()->id);

        return redirect(route('DoctorNoteManager.notes.all'))->with('msg', 'Note Added Successfully.');
    }

    public function edit($id)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['note'] = NoteHelper::get($id);

        $response['patients'] = UserHelper::getPatients();

        return view('doctor.notes.edit')->with($response);
    }

    public function update(Request $request, $id)
    {
        NoteHelper::updateNote($request->all(), $id);

        return redirect(route('DoctorNoteManager.notes.all'))->with('msg', 'Note Updated Successfully.');
    }

    public function delete($id)
    {
        NoteHelper::delete($id);

        return redirect(route('DoctorNoteManager.notes.all'))->with('msg', 'Note Deleted Successfully.');
    }
}
