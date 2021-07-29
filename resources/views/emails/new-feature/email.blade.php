@component('mail::message')
# Comments are here

You can now engage with other wannabes using the new comments feature.

<img src="data:image/png;base64,{{base64_encode(file_get_contents(resource_path('views/emails/new-feature/comments.png')))}}" alt="">

Be awesome,<br>
{{ config('app.name') }}
@endcomponent
