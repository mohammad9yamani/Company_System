


<!-- Transfers Table -->
<table>
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Buyer National ID</th>
            <th>Seller National ID</th>
            <th>Vehicles Num</th>
            <th>Buyer Phone</th>
            <th>Seller Phone</th>
            <th>Cost</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transferDocs as $transfer)
        <tr>
            <td>{{ $transfer->company->name }}</td>
            <td>{{ $transfer->buyer_national_id }}</td>
            <td>{{ $transfer->seller_national_id }}</td>
            <td>{{ $transfer->vehicles_num }}</td>
            <td>{{ $transfer->buyer_phone }}</td>
            <td>{{ $transfer->seller_phone }}</td>
            <td>{{ $transfer->cost }}</td>
            <td>{{ $transfer->status }}</td>
            <td>
                <!-- Button to Open Transfer Contract Modal -->
               <button type="button" onclick="openContractModal({{ $transfer->id }})">View Contract</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Transfer Contract Modal -->
{{-- <div id="contractModal" style="display: none;">
    <div>
        <h2>Transfer Contract</h2>
        <div id="contractContent"></div>
        <button onclick="closeContractModal()">Close</button>
    </div>
</div> --}}

<!-- JavaScript for Modal -->
{{-- <script>
    function openContractModal(transferId) {
        // Fetch the contract details using AJAX
        fetch(`/transfers/${transferId}/contract`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('contractContent').innerHTML = data;
                document.getElementById('contractModal').style.display = 'block';
            });
    }

    function closeContractModal() {
        document.getElementById('contractModal').style.display = 'none';
    }
</script> --}}
