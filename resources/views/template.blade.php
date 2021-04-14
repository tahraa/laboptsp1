@if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
      
@else
<div class="alert alert-warning" role="alert">
    Vous n'avez pas l'accès à cette page.
</div>
@php
    header("Location: " . URL::to('/'), true, 302);
    exit();
@endphp
@endif


@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();  
@endphp