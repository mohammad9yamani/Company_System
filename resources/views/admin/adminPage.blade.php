@extends('layouts.adminMain')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
            <div  class="Sidebar">
                <div class="list-group-item list-group-item-action-active ">
                            <button id="profile" onclick="fillContent(this)" class="sidebar-btn">
                <i class="fas fa-tachometer-alt"></i> Profile
            </button>
            <button id="tabDashboard" onclick="fillContent(this)" class="sidebar-btn" >
                <i class="fas fa-copy"></i>  Dashboard
            </button>
            <button id="history" onclick="fillContent(this)" class="sidebar-btn" >
                <i class="fas fa-file-alt"></i> History
            </button>

            <button  class="sidebar-btn" style="margin-top: auto; background-color:red; color:white;" 
                onclick="logout()">
                <i class="fas fa-file-alt"></i> Log out
            </button>
                
                </div>
            </div>
        <style>
                        /* General Sidebar Styles */
            .col-md-3 {
                background-color: #343a40; /* Dark sidebar background */
                color: white;
                padding: 20px 10px;
                display: flex;
                flex-direction: column;
                
            }

            .list-group {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px; /* Adds space between buttons */
            }

            .sidebar-btn {
                background-color: transparent;
                color: white;
                border: none;
                text-align: left;
                padding: 10px 15px;
                font-size: 16px;
                display: flex;
                align-items: center;
                gap: 10px; /* Space between icon and text */
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .sidebar-btn i {
                font-size: 18px;
            }

            .sidebar-btn:hover, 
            .sidebar-btn:focus {
                background-color: #495057; /* Highlight on hover or focus */
            }

            .sidebar-btn.active {
                background-color: #007bff; /* Active button style */
                color: white;
            }

            .sidebar-btn:last-child {
                margin-top: auto; /* Push the logout button to the bottom */
                background-color: red;
                color: white;
            }

            .sidebar-btn:last-child:hover {
                background-color: darkred; /* Darker red on hover for logout */
            }

            /* Responsive Styling */
            @media (max-width: 768px) {
                .col-md-3 {
                    width: 100%;
                    height: auto;
                }

                .sidebar-btn {
                    font-size: 14px;
                    padding: 8px 10px;
                }

                .list-group {
                    gap: 5px;
                }
            }

        </style>

        <!-- Main Content -->
         <div id="main-content" class="col-md-9">

         </div>
       
    </div>
</div>
C:/Projects/abdullah_Transfer_of_ownership/Company_System 


<style>
    .content-section { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
    .list-group-item.active { background-color: #007bff; color: white;  
        
    }
    .sidebar-btn{
        background: #5890ff
    }
    <style>
    /* Sidebar custom styles */
    .Sidebar {
        width: 250px;
        background-color: #343a40; /* Dark background */
    }

    .Sidebar .list-group-item {
        transition: background-color 0.3s, color 0.3s;
        
    }

    .Sidebar .list-group-item:hover {
        background-color: #999999; /* Slightly lighter on hover */
        color: #ffffff; /* Ensure text stays white */
    }

    .Sidebar .list-group-item.active {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        
    }

    .sidebar-btn i {
        margin-right: 10px; /* Space between icon and text */
        margin-bottom: 20px;
    }

    /* Log out button hover effect */
    .Sidebar .list-group-item.bg-danger:hover {
        background-color: #dc3545; /* Bootstrap danger hover color */
    }
    
</style>

</style>
@endsection
