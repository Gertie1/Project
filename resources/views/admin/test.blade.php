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


------------------------------------------------------------
//An array that will contain the IDs of posts that have already
//been appended.
var displayedPosts = new Array();

//Function to get feed.
function getFeed() {
$.ajax({
type: "GET",
url: "api.php",
dataType: 'json',
success: function(data) {
var posts = data.posts
$.each(posts, function(i) {
//Make sure that this post hasn't already been added.
if($.inArray(posts[i].id, displayedPosts) === -1){
//Store the ID of the post so that we don't add it again.
displayedPosts.push(posts[i].id);
//Append
$('#posts').append("<div class='post' id='" + posts[i].id + "'>" + "<div class='content'>" + posts[i].post + "</div>" + "<div class='meta'><div class='d'>" + posts[i].time + "</div> - <a href='/edit/" + posts[i].id +"'>Edit</a> - <a href='destroy.php?id=" + posts[i].id + "'>Delete</a></div></div>");
}
});
}
});
}


/*      $insert = array();
foreach ($input as $key=> $input)
{
foreach($input['drug'] as $key => $drug) {
$insert[$key]['drug'] = $drug;
}
foreach($input['amount_received'] as $key => $amount_received) {
$insert[$key]['amount_received'] = $amount_received;

}
}*/

/* Stock::insert($insert);*/
/* $item = Stock::create([
'drug_id' =>  $drug,
'amount_received' => $amount_received,

]);
$item->save();*/

/*$drug = Input::get('drug');
$amount_received = Input::get('amount_received');
$n=0;
/*dd($drug);*/
/*dd($amount_received);

/* foreach($drug as $key => $n )
{

$arrData[] = array(
"amount_received"       => $amount_received[$key],
"drug_id"       => $drug[$key],

);

}
Stock::create( $arrData );*/


@if ( session()->has('Success') ) <div class="alert alert-success" role="alert">



    @if (!$errors->isEmpty()) <div class="alert alert-danger" role="alert"> <strong>Errors:</strong> <ul> @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif