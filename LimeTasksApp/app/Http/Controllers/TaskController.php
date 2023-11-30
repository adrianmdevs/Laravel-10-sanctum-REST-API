<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with("project", "employee", 'subtasks')->orderBy('deadline')->get();

        foreach($tasks as $task){

                $userID = $task->employee->user_id;
                $employee = User::where('id', $userID)->get();

                $task->employee->name = $employee[0]->name;
                $task->employee->email = $employee[0]->email;

                $subTasks = $task->subtasks;
                $completeSubtasks = [];

                foreach($subTasks as $subtask) {

                    if($subtask->status == "complete") {

                        $completeSubtasks[] = $subtask;
                    }
                }

                if($completeSubtasks){
                    $task['progress'] = (count($completeSubtasks) / count($subTasks)) * 100;

                } else {
                    $task['progress'] = 0;
                }

        };
        
        return $tasks;
        
    }

    public function overdueTasks()
    {
        $tasks = Task::with("employee", "subtasks")->orderBy('deadline')->get();

        $overdueTasks = [];

        foreach($tasks as $task){

            $date = Carbon::now()->format('Y-m-d');

            if($task->deadline <= $date){
                $userID = $task->employee->user_id;
                $employee = User::where('id', $userID)->get();

                $task["name"] = $employee[0]->name;

                $overdueTasks[] = $task;
            }
            
        }

        return $overdueTasks;
    }


    public function tasksByDate($date){
        $tasks = Task::with('employee', 'subTasks')->get();

        $newTasks = [];

        foreach($tasks as $task){
            $deadline = $task->deadline;
            $userID = $task->employee->user_id;
            $employee = User::where('id', $userID)->get();

            $task->employee->name = $employee[0]->name;
            $task->employee->email = $employee[0]->email;

            if($deadline == $date){
                $newTasks[] = $task;
            };
        };

        return $newTasks;
    }



    public function store(Request $request)
    {

        try {
            $task = Task::create([
                "task_title" => $request -> task_title,
                "project_id" => $request -> project_id,
                "employee_id" => $request -> employee_id,
                "description" => $request -> description, 
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
                "priority" => $request -> priority ? 1 : 0
            ]);

            return ([
                $task, 
                "message" => "Task added to this project"
            ]);
        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
    }


    public function show(string $id)
    {
        
        $task = Task::with("project", "employee", 'subtasks')->find($id);
        $userID = $task->employee->user_id;
        $employee = User::where('id', $userID)->get();
        // $employeeDpt = Department::where('id', $userID)->get();
        
        
        $task->employee['name'] = $employee[0]->name;
        $task->employee['email'] = $employee[0]->email;
        // $task->employee['department'] = $employeeDpt;
        
        
        return $task;
    }

    public function update(Request $request, $id)
    {
        
        try {
            $task = Task::find($id);

            $task->update([
                "description" => $request -> description, 
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
                // "priority" => $request -> priority ? 1 : 0,
                "status" => $request -> status,
                "employee_id" => $request -> employee_id,
                "task_title" => $request -> task_title,
            ]);

            return response([
                $task,
                "message" => "Task has been updated",
            ]);
        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
    }


    public function destroy(string $id){
        $task = Task::find($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
