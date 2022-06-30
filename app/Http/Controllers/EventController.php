<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
	public function index(){

		$search = request('search');

		if ($search) {
			$events = Event::where([['title', 'like', '%' .$search. '%']])->get();
		}
		else{

			$events = Event::all();
		}

		return view('welcome', ['events' => $events, 'search' => $search ]);
	}

	public function create(){
		return view ('events.create');
	}

	public function store(Request $request){

		$event = new Event;


		$user = auth()->user();//pega o id do usuario logado

		$event->user_id		= $user->id; //preenche o user_id na tabela events
		$event->title		= $request->title;
		$event->date 		= $request->date;
		$event->city 		= $request->city;
		$event->private 	= $request->private;
		$event->description = $request->description;
		$event->items 		= $request->items;

		//image upload
		if($request->hasFile('image') && $request->file('image')->isValid()){

			$requestImage = $request->image;

			//Pega a extenção da imagem
			$extension = $requestImage->extension(); 
			
			//Pega o nome da imagem original transforma em md5 e concatena com a hora de agora e com a extensão do arquivo
			$imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 

			//Faz o save da imagem na pasta
			$request->image->move(public_path('img/events'), $imageName);

			$event->image = $imageName;
		}




		$event->save();

		return redirect('/')->with('msg', 'Evento criado com sucesso!');
	}

	public function show($id){

		$user = auth()->user();
		$hasUserJoined = false;

		if ($user) {
			$userEvents = $user->eventsAsParticipant->toArray();

			foreach ($userEvents as $userEvent) {

				//o primeiro id  do IF contido em userEvent['id'] é o id do evento que vem da tabela de ligação com o usuario e o segundo é o que vem do request que é ate passado como parametro na função.
				if ($userEvent['id'] == $id) { 
					$hasUserJoined = true;
				}
			}

		}


		$event = Event::findOrFail($id);
		$eventOwner = User::where('id', $event->user_id)->first()->toArray();


		return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner,'hasUserJoined' => $hasUserJoined] );
	}

	public function dashboard(){

		$user 					= auth()->user();
		$events 				= $user->events; //Propriedade que vem do model User função events
		$eventsAsParticipant	= $user->eventsAsParticipant;

		return view ('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);

	}

	public function destroy($id){

		Event::findOrFail($id)->delete();
		return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
	}

	 public function edit($id){

	 	$user = auth()->user();

	 	if ($user->id != $event->user_id) {
	 		return redirect('/dashboard')->with('msg', 'Você não pode editar esse evento');
	 	}

		$event = Event::findOrFail($id);

		return view('events.edit', ['event' => $event]);

	 }

	  public function update(Request $request){
		$data = $request->all();

		//image upload
		if($request->hasFile('image') && $request->file('image')->isValid()){

			$requestImage = $request->image;

			//Pega a extenção da imagem
			$extension = $requestImage->extension(); 
			
			//Pega o nome da imagem original transforma em md5 e concatena com a hora de agora e com a extensão do arquivo
			$imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 

			//Faz o save da imagem na pasta
			$request->image->move(public_path('img/events'), $imageName);

			$data['image'] = $imageName;
		}

		Event::findOrFail($request->id)->update($data);

		return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso!');

	 }

	  public function joinEvent($id){

	  	$user = auth()->user();

     	$user->eventsAsParticipant()->attach($id);

     	$event = Event::findOrFail($id);

     	return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento'. $event->title);

     }

     public function leaveEvent($id){

     	$user = auth()->user();

     	$user->eventsAsParticipant()->detach($id);

     	$event = Event::findOrFail($id);

     	return redirect('/dashboard')->with('msg', 'Você removeu sua presença do evento '. $event->title . ' com sucesso!');
 
     }

}
