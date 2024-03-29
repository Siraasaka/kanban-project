<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Ditambahkan

class TaskController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $pageTitle = 'Task List';
        $tasks = Task::all(); // Diperbarui
        return view('tasks.index', [
            'pageTitle' => $pageTitle,
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        $pageTitle = 'Create Task';
        return view('tasks.create', ['pageTitle' => $pageTitle]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'name' =>'required',
            'due_date' =>'required',
            'status' =>'required',
            ],
            $request->all()
        );

        Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Task';
        $task = Task::find($id); // Diperbarui

        return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
    }
    
    public function update(Request $request, $id) 
        {
            $request->validate(
                [
                'name' =>'required',
                'detail' =>'required',
                'due_date' =>'required',
                'status' =>'required',
                ],
                $request->all()
            );

            $task = Task::find($id); // Diperbarui
            $task->update([
                    // data task yang berasal dari formulir
                'name' => $request->name,
                'detail' => $request->detail,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            return redirect()->route('tasks.index');
        }

        public function delete($id)
        {
            // Menyebutkan judul dari halaman yaitu "Delete Task"
            $pageTitle = "Delete Task";
    
            // Memperoleh data task menggunakan $id
            $task = Task::find($id);
    
            // Menghasilkan nilai return berupa file view dengan halaman dan data task di atas
            return view('tasks.delete', compact('pageTitle', 'task'));
        }
    
        public function destroy($id)
        {
    
            // Menghapus task dari database
            $task = Task::find($id);
            $task->delete();
    
            // Redirect atau berikan respon sukses
            return redirect()->route('tasks.index');
        }
}