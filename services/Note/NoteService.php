<?php

namespace services\Note;

use App\Note;

class NoteService
{
    protected $note;

    public function __construct()
    {
        $this->note = new Note();
    }

    public function get($id)
    {
        return $this->note->find($id);
    }

    public function getAll()
    {
        return $this->note->all();
    }

    public function create($data)
    {
        return $this->note->create($data);
    }

    /**
     * update
     *
     * @param  mixed $note
     * @param  mixed $data
     * @return void
     */
    public function update(Note $note, array $data)
    {
        return $note->update($this->edit($note, $data));
    }

    /**
     * edit
     *
     * @param  mixed $note
     * @param  mixed $data
     */
    protected function edit(Note $note, $data)
    {
        return array_merge($note->toArray(), $data);
    }

    public function delete($id)
    {
        $note = $this->get($id);
        return $note->delete();
    }

    public function saveNote($data, $doctor_id)
    {
        $data['doctor_id'] = $doctor_id;

        return $this->create($data);
    }

    public function updateNote($data, $id)
    {
        $note = $this->get($id);
        $this->update($note, $data);
    }
}
