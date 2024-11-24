<table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>created_at</th>
      
      </tr>
    </thead>
    <tbody>

        @forelse ($clients as $client)

        <tr>
            <td>{{$client->name}}  </td>
            <td>{{$client->email}} {!!$client->email_verified_at ? '<span style="color:green"> (verified) </span> ': '<span style="color:rgb(255, 7, 7)"> (not-verified) </span>'!!}  </td >
            <td>{{$client->created_at}}  </td>
           
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align: center;">No data found</td>
        </tr>
       
        @endforelse
    </tbody>

  </table>
