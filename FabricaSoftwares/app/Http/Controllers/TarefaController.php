<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function tarefa(Tarefa $tarefa, Request $request)
    {
        $tarefas = $tarefa->query()
            ->where('id_usuarios', Auth::id())
            ->get();

        return view('tarefa', [
            'tarefas' => $tarefas
        ]);
    }
    public function store(Tarefa $tarefa, Request $request, Usuario $usuario)
    {
        $data =  $request->all();

        $tarefa = $tarefa->create($data + ['id_usuarios' => Auth::id()]);

        return redirect()->back();
    }
    public function delete(Tarefa $tarefa, Request $request)
    {
        if ($tarefa->id_usuarios !== Auth::id()) {
            return to_route('tarefa');
        }

        $tarefa->delete();

        return redirect()->back();
    }

    public function edit($id)
    {
        $tarefa = Tarefa::query()
            ->where('id', $id)
            ->where('id_usuarios', Auth::id())
            ->first();

        if (!$tarefa) {
            return to_route('tarefa');
        }

        return view('tarefaEdit', compact('tarefa'));
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::query()
            ->where('id', $id)
            ->where('id_usuarios', Auth::id())
            ->first();

        if (!$tarefa) {
            return to_route('tarefa');
        }

        $tarefa->update($request->all());

        return redirect()->route('tarefa');
    }
}
