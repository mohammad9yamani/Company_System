<div class="container" style="display:grid;grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);gap: 10px;">

    <div class="card" style="display:flex;align-items: center;">
        <h3>Compaines</h3>
        <h3>{{$compaines ? $compaines : '--' }}</h3>
    </div>

    <div class="card" style="display:flex;align-items: center;">
        <h3>clients</h3>
        <h3>{{$clients ? $clients : '--' }}</h3>
    </div>

    <div class="card" style="display:flex;align-items: center;">
        <h3>vehicles</h3>
        <h3>{{$vehicles ? $vehicles : '--' }}</h3>
    </div>

    <div class="card" style="display:flex;align-items: center;">
        <h3>transfer-appending</h3>
        <h3>{{$status1 ? $status1 : '--' }}</h3>
    </div>

    <div class="card" style="display:flex;align-items: center;">
        <h3>transfer-printed</h3>
        <h3>{{$status2 ? $status2 : '--' }}</h3>
    </div>

    <div class="card" style="display:flex;align-items: center;">
        <h3>transfer-done</h3>
        <h3>{{$status3 ? $status3 : '--' }}</h3>
    </div>



</div>