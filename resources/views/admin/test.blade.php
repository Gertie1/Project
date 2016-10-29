public function checkbox()
{
$checkboxes         = Input::get('checkbox');

foreach ($checkboxes as $key => $value)
{
if($value !== '0')
{
Products::where('id', '=', $key) ->update(['chkupdate' => '1']);
}
else {
Products::where('id', '=', $key) ->update(['chkupdate' => '0']);
}
}
return Redirect::to('index');
}

public function store(Request $request)
{
$ids = $request->get('users.ids', []); // Empty array by default if no checkbox checked.
}

$roles = $request->get('role');

$foreach($roles as $role)
{
$user->roles()->attach($role);
}

$drugString = implode(",", $request->get('drug'));

$status = Disease_Drug::create([
'name' => $request->get('disease'),
'drug' => $drugString,
'drug_id' => $request->get('drug_id'),
'disease_id' => $request->get('disease_id'),


]);


if($status)
{
\Session::flash('flash_message','created!!');
} else {
\Session::flash('flash_message','Error!');
}

return redirect('admin.form');
}


$diseases = $request->get('diseases.ids');
$drugs = $request->get('drugs.id', []); // Empty array by default if no checkbox checked.
$diseases->drugs()->sync($request->input('drugs', []));
$diseases->save();
$drugs->save();
$item->drugs = implode(',', Input::get('drugs'));
