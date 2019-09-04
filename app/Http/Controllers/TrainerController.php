<?php

namespace LaraDex\Http\Controllers;

use Illuminate\Http\Request;

use LaraDex\Trainer;

use LaraDex\Http\Requests\StoreTrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $trainers = Trainer::all(); //consulta todos los trainers y lo almacena en un arreglo
        return view('trainers.index', compact('trainers'));    //compact es un parametro del metodo vista que genera un array de la informacion que se le pasa como parametro, sinel signo $
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('trainers.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainerRequest $request)
    {

        //verificamos y tratamos el archivo imagen
        if($request->hasFile('avatar')){    //pregunto si es una archivo de tipo imagen llamado avatar
            $file = $request->file('avatar');   //guardamos el archiv
            $name = time().$file->getClientOriginalName();  //nos aseguramos que el archivo tenga un nombre unico
            $file->move(public_path().'/images', $name);

        }

        $trainer = new Trainer(); //instancia del modelo Trainer
        $trainer->name = $request->input('name');
        $trainer->avatar = $name;
        $trainer->slug = $trainer->name.'-'. time();
        $trainer->save();

        //con el metodo with enviamos datos a la vista que a la cual redireccionamos
        return redirect()->route('trainers.index')->with('status','Entrenador agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        //return 'tengo que retornar el recurso con el id: '.$id;
        //$trainer = Trainer::find($id);  //hace busqueda en la BD el registro con ese id y lo guarda
        //$trainer = Trainer::where('slug','=',$slug)->firstOrFail(); //busca el producto comparando el slug y lanza una excepcion si no lo encuentra 
        return view('/trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        return view('/trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $trainer->fill($request->except('avatar'));

        //verificamos y tratamos el archivo imagen
        if($request->hasFile('avatar')){    //pregunto si es una archivo de tipo imagen llamado avatar
            $file = $request->file('avatar');   //guardamos el archiv
            $name = time().$file->getClientOriginalName();  //nos aseguramos que el archivo tenga un nombre unico
            $trainer->avatar = $name;
            $file->move(public_path().'/images', $name);

        }

        $trainer->save();

        //con el metodo with enviamos datos a la vista que a la cual redireccionamos
        return redirect()->route('trainers.show', [$trainer])->with('status','Entrenador actualizado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        //busca la ruta en donde esta el archivo, en este caso el archivo imagen
        $file_path = public_path().'/images/'.$trainer->avatar;
        //borra archivo imagen, en este caso el avatar
        \File::delete($file_path);
        //elimina todo el registro
        $trainer->delete();

        //con el metodo with enviamos datos a la vista que a la cual redireccionamos
      return redirect()->route('trainers.index')->with('status','Entrenador borrado correctamente');
    }
}
