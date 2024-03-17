<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        return view("dashboard.categoria.index");
    }

    public function listado(Request $request)
    {
        $registrosPorPagina = $request->input("registrosPorPagina",15);
        $paginaActual = $request->input("paginaActual",1);;
        $buscar = $request->input("buscar");

        $categorias = Categoria::query()
            ->with(["padre"])
            ->when(!empty($buscar),function ($q) use ($buscar){
                $q->where("nombre","LIKE","%{$buscar}%");
            })
            ->orderByDesc("id")
            ->paginate($registrosPorPagina,"*","page",$paginaActual);

        return response()->json([
            "categorias" => $categorias
        ],Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $categoriasPadre = Categoria::query()->whereNull("categoria_padre_id")->orderBy("nombre","ASC")->get();

        return view("dashboard.categoria.crear")->with(compact("categoriasPadre"));
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->fill($request->all());
        $categoria->nombre_slug = Str::slug($request->input("nombre"));
        $categoria->save();

        return response()->json([
            "mensaje" => "Categoria creada satisfactoriamente"
        ],Response::HTTP_CREATED);
    }

    public function show(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);

        return response()->json([
            "categoria" => $categoria
        ],Response::HTTP_OK);
    }

    public function edit(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);
        $categoriasPadre = Categoria::query()->whereNull("categoria_padre_id")->orderBy("nombre","ASC")->get();

        return view("dashboard.categoria.editar")->with(compact("categoria","categoriasPadre"));
    }

    public function update(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);
        $categoria->fill($request->all());
        $categoria->nombre_slug = Str::slug($request->input("nombre"));
        $categoria->update();

        return response()->json([
            "mensaje" => "Categoria modificada satisfactoriamente"
        ],Response::HTTP_OK);
    }

    public function destroy(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);
        $categoria->delete();

        return response()->json(null,Response::HTTP_NO_CONTENT);
    }

    public function habilitar(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);
        $categoria->estado = 1;
        $categoria->update();

        return response()->json([
            "mensaje" => "Categoria habilitada satisfactoriamente"
        ],Response::HTTP_OK);
    }

    public function inhabilitar(Request $request,$id)
    {
        $categoria = Categoria::query()->findOrFail($id);
        $categoria->estado = 0;
        $categoria->update();

        return response()->json([
            "mensaje" => "Categoria inhabilitada satisfactoriamente"
        ],Response::HTTP_OK);
    }
}
