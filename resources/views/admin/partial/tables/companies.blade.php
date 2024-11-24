
    <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Done</th>
            <th>Appending</th>
            <th>Printed</th>
            <th>action </th>


          </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)

            <tr>
                <td>{{$company->name}}  </td>
                <td>{{$company->email}} {!!$company->email_verified_at ? '<span style="color:green"> (verified) </span> ': '<span style="color:rgb(255, 7, 7)"> (not-verified) </span> '!!}  </td>
                <td>{{$company->phone}}  </td>
                <td>{{$company->address}}  </td>
                <td>{{$company->transfardocs()->where('status','done')->count()}}  </td>
                <td>{{$company->transfardocs()->where('status','appending')->count()}}  </td>
                <td>{{$company->transfardocs()->where('status','printed')->count()}}  </td>
                <td>
                    <button class="btn btn-primary" onclick="showCompanyDocs({{ $company->id }})">Show</button>
                </td>

            </tr>
                
            @endforeach
        </tbody>

      </table>
  