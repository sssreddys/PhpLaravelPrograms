<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<table class="table">
<thead class='bg-warning'>
<th scope='col'>Id</th>
<th scope='col'>Title</th>
</thead>
<tbody>
@foreach ($posts as $post)
      <tr>
        <td>{{  $post->id}}</td>
        <td>{{  $post->title}}</td>
     </tr>
@endforeach

</tbody>
</table>