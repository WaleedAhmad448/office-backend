<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Person;
use Illuminate\Support\Facades\Storage;

Use Log;

class PersonController extends Controller
{
    // https://carbon.now.sh/
    public function getAll(){
      $data = Person::get();
      return response()->json($data, 200);
    }

    public function create(Request $request)
        {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ];

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/storage', $fileName);
                $data['photo'] = $fileName;
            }

            Person::create($data);

            return response()->json([
                'message' => "Successfully created",
                'success' => true
            ], 200);
        }
    public function delete($id){
      $res = Person::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/storage', $fileName);
            $data['photo'] = $fileName;
        }

        Person::find($id)->update($data);

        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function get($id)
        {
            $person = Person::find($id);
            if ($person->photo) {
                $person->photo = asset('/storage' . $person->photo);
            }
            return response()->json($person, 200);
        }
 }

