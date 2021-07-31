@component('mail::message')
 Hey there {{ $name }} 👋

You can now engage with other wannabes using the new comments feature.

<img src="data:image/png;base64,{{base64_encode(file_get_contents($pathToFile))}}" alt="">

Be awesome,<br>
^C
@endcomponent
