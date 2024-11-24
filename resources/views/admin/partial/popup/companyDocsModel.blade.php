<table>
    <thead>
      <tr>

        <th>Buyer National ID</th>
        <th>Seller National ID</th>
        <th>Vehicles Num</th>
        <th>Buyer Phone</th>
        <th>Seller Phone</th>
        <th>Cost</th>
        <th>Status</th>
        <th>Contract</th>
        <th>Created At</th>
        <th>Updated At</th>



      </tr>
    </thead>
    <tbody>
        @foreach ($companyDocs as $companyDoc)

        <tr>

            <td>{{$companyDoc->buyer_national_id}}</td>
            <td>{{$companyDoc->seller_national_id}}</td>
            <td>{{$companyDoc->vehicles_num}}</td>
            <td>{{$companyDoc->buyer_phone}}</td>
            <td>{{$companyDoc->seller_phone}}</td>
            <td>{{$companyDoc->cost}}</td>
            <td>{{$companyDoc->status}}</td>
            <td>
                @if($companyDoc->contract_file_path)
                    <a href="{{ asset($companyDoc->contract_file_path) }}" target="_blank">View Contract</a>
                @else
                    No Contract
                @endif
            </td>
            <td>{{$companyDoc->created_at}}</td>
            <td>{{$companyDoc->updated_at}}</td>
        </tr>
        
            
        @endforeach
    </tbody>

  </table>