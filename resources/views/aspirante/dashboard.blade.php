@extends('aspirante.layouts.aspirante')

@section('extra-css')

    <style>
        .row {
            padding-top: 50px;
            padding-right: 30px;
            padding-bottom: 50px;
            padding-left: 30px;
        }
        #crd:hover {
            transform: translateY(-5px);
            border: none;
            border-bottom: 7px solid #2196fe;
            transition: all 0.25s ease-in;
        }


    </style>

@endsection

@section('content')
    <main>
        <div class="bg-primary">
            <div class="container py-4">
                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="mb-0">Bienvenido<br> {{ get_user_full_name() }} <br> Folio CENEVAL: {{ get_aspirante()->folio }}</h5>

                    </div>

                    <!-- Edit Profile -->
                    <a class="btn bg-white" style="color: #1f2d3d!important" href="{{ route('aspirante.profile') }}">
                        <i class="fa fa-user small mr-2"></i>
                        Editar perfil
                    </a>
                    <!-- End Edit Profile -->
                </div>

            </div>
        </div>




        <div>

        </div>






             <div style="background-color: RGBA(248, 249, 250, 1.00)">
                <div class=" row container py-4" style="margin-left: 2cm">
                    <div class="col-lg-3 mb-7 mb-lg-0">
                        <div class="card shadow-none border p-1 mb-4">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if(get_aspirante()->sexo == 'H')
                                        <img class="rounded-circle" style="max-width: 100px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzMzNzE4MDsiIGQ9Ik0yNDguMSw0OTYuMmM3MC4yLDAsMTMzLjYtMjkuMiwxNzguNy03NmMtMi44LTE1LjEtNS42LTI4LjktOC4zLTM3LjQgIGMtOC41LTI3LjMtODEuMi00OS4zLTE3MC44LTQ5LjNzLTE2MS41LDIyLTE3MCw0OS4zYy0yLjYsOC41LTUuNSwyMi4yLTguMywzNy40QzExNC41LDQ2NywxNzcuOSw0OTYuMiwyNDguMSw0OTYuMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0yOTMuOSwzMzYuMmMtMTQuNS0xLjgtMzAtMi43LTQ2LjEtMi43Yy0xNS45LDAtMzEuMiwwLjktNDUuNSwyLjdsNDUuOCw5MUwyOTMuOSwzMzYuMnoiLz4KPHJlY3QgeD0iMjA1LjEiIHk9IjMyNC45IiBzdHlsZT0iZmlsbDojREVFMEUyOyIgd2lkdGg9Ijg2IiBoZWlnaHQ9IjI1Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFMkEzNzk7IiBkPSJNMjQ4LjEsNDEyLjFsLTM3LjgtNzYuOGMwLDAsOS4yLTEyLjQsMzcuNC0xMi40czM4LjEsMTIuNSwzOC4xLDEyLjVMMjQ4LjEsNDEyLjF6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0xNjguMSwzNTcuMmwzNy0zMi4zbDMyLDYzLjljMCwwLTI1LjIsNy4xLTI1LjUsNi44TDE2OC4xLDM1Ny4yeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0zMjguMSwzNTcuMmwtMzctMzIuM2wtMzIsNjMuOWMwLDAsMjUuMiw3LjEsMjUuNSw2LjhMMzI4LjEsMzU3LjJ6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yODcsMjgyLjFoLTc3LjhjMTIuMSwzNi42LDEsNTMuMywxLDUzLjNzMTYuOSw2LjEsMzcuOSw2LjFzMzcuOS02LjEsMzcuOS02LjEgIFMyNzQuOSwzMTguNywyODcsMjgyLjF6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGNEIzODI7IiBkPSJNMzM2LjQsMTc1LjJjMC05Mi40LTM5LjUtMTEzLjYtODguMy0xMTMuNmMtNDguNywwLTg4LjMsMjEuMi04OC4zLDExMy42YzAsMzEuMyw2LjIsNTUuOCwxNS41LDc0LjcgIGMyMC40LDQxLjYsNTUuNyw1Ni4xLDcyLjgsNTYuMXM1Mi40LTE0LjUsNzIuOC01Ni4xQzMzMC4yLDIzMSwzMzYuNCwyMDYuNSwzMzYuNCwxNzUuMnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkxOTE5OyIgZD0iTTI0Ny42LDI5Mi45aDAuNUMyNDcuOSwyOTIuOSwyNDcuOCwyOTIuOSwyNDcuNiwyOTIuOUwyNDcuNiwyOTIuOXoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTE5MTk7IiBkPSJNMjQ4LjYsMjkyLjlMMjQ4LjYsMjkyLjljLTAuMiwwLTAuMywwLTAuNSwwSDI0OC42eiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNzAuNCwyMzguN2MtOC40LDEuNC0xNC40LDAuMS0xOS4xLTI3LjdzMS43LTMxLjUsMTAuMS0zMi45TDE3MC40LDIzOC43eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0zMjUuOSwyMzguN2M4LjQsMS40LDE0LjMsMC4xLDE5LjEtMjcuN2M0LjgtMjcuOC0xLjctMzEuNS0xMC4xLTMyLjlMMzI1LjksMjM4Ljd6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0U1QTE3MzsiIGQ9Ik0yNzQuOCwyNTdjMCwyLjYtMTEuOSw5LjUtMjYuNyw5LjVzLTI2LjctNy0yNi43LTkuNWMwLTEuNiw4LjUtNi4xLDE0LjEtNi45ICBjMy42LTAuNSwxMi41LDIuOSwxMi41LDIuOXM4LjgtMy40LDEyLjQtMi45QzI2Ni4yLDI1MC45LDI3NC44LDI1NywyNzQuOCwyNTd6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNEODkzNjQ7IiBkPSJNMjc0LjgsMjU3YzAsMi42LTExLjksMTIuNC0yNi43LDEyLjRzLTI2LjctOS45LTI2LjctMTIuNGMwLDAsMTAuOSwxLjMsMjYuNywxLjMgIFMyNzQuOCwyNTcsMjc0LjgsMjU3eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM3NzNBMjM7IiBkPSJNMzM2LjQsMTc1LjJjMC05Mi40LTMwLjMtMTE2LjEtODguMy0xMTYuMXMtODguMywyMy43LTg4LjMsMTE2LjFsMzkuOC0zMy4xYzAsMCwyNi41LDAsNDguNSwwICAgczQ2LjItMzUuMyw0Ni4yLTM1LjNMMzM2LjQsMTc1LjJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNzczQTIzOyIgZD0iTTMzMC44LDE0MC44YzQuMiwxMC45LDUuNiwyNC40LDUuNiwzNy41YzAsMC04LjgtMS45LTguOCwyLjZsLTIuOCwyNy42bC0zLjktMS45ICAgYzAuMi0yMy00LjktNjYuMi00LjktNjYuMkwzMzAuOCwxNDAuOHoiLz4KPC9nPgo8cmVjdCB4PSIxNjEiIHk9IjkzLjYiIHN0eWxlPSJmaWxsOiMyNDJEMkI7IiB3aWR0aD0iMTc0LjEiIGhlaWdodD0iMzkiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzE4MUUxRDsiIGQ9Ik0yNTcuOSwxMjUuN2MtNS40LDEuNi0xNC4yLDEuNi0xOS42LDBMMTE4LjcsODkuMWMtMi44LTAuOC00LjEtMi00LjEtMy4xdi00LjFoMjY3YzAsMCwwLDQuMSwwLDQuMiAgYzAsMS4xLTEuNCwyLjItNC4xLDNMMjU3LjksMTI1Ljd6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyQTM2MzM7IiBkPSJNMjU3LjksMTIxLjVjLTUuNCwxLjYtMTQuMiwxLjYtMTkuNiwwTDExOC43LDg0LjljLTUuNC0xLjctNS40LTQuMywwLTZsMTE5LjYtMzYuNiAgYzUuNC0xLjcsMTQuMi0xLjcsMTkuNiwwbDExOS42LDM2LjZjNS40LDEuNyw1LjQsNC4zLDAsNkwyNTcuOSwxMjEuNXoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyMy44LDk5Yy0wLjksMC0xLjYsMC43LTEuNiwxLjZ2NjUuOGMwLDAuOSwwLjcsMS42LDEuNiwxLjZzMS42LTAuNywxLjYtMS42di02NS44ICAgQzMyNS40LDk5LjcsMzI0LjcsOTksMzIzLjgsOTl6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyNC4yLDk5LjFsLTY3LjktMjEuMmMtMC45LTAuMy0xLjgsMC4yLTIsMS4xYy0wLjMsMC45LDAuMiwxLjgsMS4xLDJsNjcuOSwyMS4yICAgYzAuOSwwLjMsMS44LTAuMiwyLTEuMUMzMjUuNiwxMDAuMiwzMjUuMSw5OS4zLDMyNC4yLDk5LjF6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyOC4yLDEzNS4zYzAsMi44LTIsNS4xLTQuNSw1LjFzLTQuNS0yLjMtNC41LTUuMXMyLTUuMSw0LjUtNS4xUzMyOC4yLDEzMi41LDMyOC4yLDEzNS4zeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjIuMiwxMzkuNmMwLDAtNC41LDUuMi00LjUsOC4zYzAsMS4zLDAsOC42LTAuMSwxMy44YzAsMy4yLTIuNCw1LjctMi40LDUuNyAgIGMwLDEuOCwxNi45LDEuOCwxNi45LDBjMCwwLTIuNC0yLjQtMi40LTUuNWMwLTUuMi0wLjEtMTIuMy0wLjEtMTMuOGMwLTMuNC00LjUtOC41LTQuNS04LjVIMzIyLjJ6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6IzE4MUUxRDsiIGQ9Ik0yNTYuOSw3Ny4xYzAsMi45LTMuOCw1LjItOC41LDUuMnMtOC41LTIuNC04LjUtNS4yYzAtMi45LDMuOC01LjMsOC41LTUuMyAgQzI1My4xLDcxLjgsMjU2LjksNzQuMiwyNTYuOSw3Ny4xeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojNzczQTIzOyIgZD0iTTE2NS41LDE0MC44Yy00LjIsMTAuOS01LjYsMjQuNC01LjYsMzcuNWMwLDAsOC44LTEuOSw4LjgsMi42bDIuOCwyNy42bDMuOS0xLjkgIGMtMC4yLTIzLDQuOS02OCw0LjktNjhMMTY1LjUsMTQwLjh6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMTEuNSwzMzcuNEwzMTEuNSwzMzcuNEwzMTEuNSwzMzcuNEwzMTEuNSwzMzcuNHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMjk4LjUsMzM1LjlMMjk4LjUsMzM1LjlMMjk4LjUsMzM1Ljl6Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="/>
                                    @elseif(get_aspirante()->sexo == 'M')
                                        <img class="rounded-circle" style="max-width: 100px" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTJBMzc5OyIgZD0iTTI4NywyODIuMWgtNzcuOGMxMi4xLDM2LjYsMSw1My4zLDEsNTMuM2wyNi45LDYuMWgyMmwyNi45LTYuMUMyODYsMzM1LjQsMjc0LjksMzE4LjcsMjg3LDI4Mi4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDguMiwzOTAuMWM0NC45LDAsMzcuOC01NC43LDM3LjgtNTQuN3MtOC45LDE3LjMtMzguMSwxNy4zcy0zNy41LTE3LjMtMzcuNS0xNy4zICAgUzIwMy4zLDM5MC4xLDI0OC4yLDM5MC4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDcuOCwzMzMuNGMtNzcuMiwwLTEzOS4xLDIyLjEtMTQ2LjQsNDkuM2MtMy4zLDEyLjItNywzNS4yLTEwLjEsNTcuNSAgIGM0Mi43LDM0LjksOTcuNCw1NS45LDE1Ni45LDU1LjlzMTE0LjEtMjEsMTU2LjktNTUuOWMtMy4yLTIyLjMtNi45LTQ1LjQtMTAuMS01Ny41QzM4Ny41LDM1NS41LDMyNC45LDMzMy40LDI0Ny44LDMzMy40eiIvPgo8L2c+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNBRjRCMTk7IiBwb2ludHM9IjM0OS4xLDQwOC4xIDE0Ny4xLDQwOC4xIDE1OS44LDE1My4xIDMzNS4yLDEzMi42ICIvPgo8cmVjdCB4PSIyMDUuMSIgeT0iMzI0LjkiIHN0eWxlPSJmaWxsOiNERUUwRTI7IiB3aWR0aD0iODYiIGhlaWdodD0iMjUiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzMzNzE4MDsiIGQ9Ik0yNDcuOCwzMzMuNGMtNzcuMiwwLTEzOS4xLDIyLjEtMTQ2LjQsNDkuM2MtMy4zLDEyLjItNywzNS4yLTEwLjEsNTcuNSAgYzQyLjcsMzQuOSw5Ny40LDU1LjksMTU2LjksNTUuOXMxMTQuMS0yMSwxNTYuOS01NS45Yy0zLjItMjIuMy02LjktNDUuNC0xMC4xLTU3LjVDMzg3LjUsMzU1LjUsMzI0LjksMzMzLjQsMjQ3LjgsMzMzLjR6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0yOTMuOSwzMzYuMmMtMTQuNS0xLjgtMzAtMi43LTQ2LjEtMi43Yy0xNS45LDAtMzEuMiwwLjktNDUuNSwyLjdsNDUuOCw5MUwyOTMuOSwzMzYuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGM0ZBRkY7IiBkPSJNMTY4LjEsMzU3LjJsMzctMzIuM2wzMiw2My45YzAsMC0yNS4yLDcuMS0yNS41LDYuOEwxNjguMSwzNTcuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGM0ZBRkY7IiBkPSJNMzI4LjEsMzU3LjJsLTM3LTMyLjNsLTMyLDYzLjljMCwwLDI1LjIsNy4xLDI1LjUsNi44TDMyOC4xLDM1Ny4yeiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDguMSw0MTIuMWwtMzcuOC03Ni44YzAsMCw5LjItMTIuNCwzNy40LTEyLjRzMzguMSwxMi41LDM4LjEsMTIuNUwyNDguMSw0MTIuMXoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNFMkEzNzk7IiBkPSJNMjg3LDI4Mi4xaC03Ny44YzEyLjEsMzYuNiwxLDUzLjMsMSw1My4zczE2LjQsNi4xLDM3LjksNi4xczM3LjktNi4xLDM3LjktNi4xICAgUzI3NC45LDMxOC43LDI4NywyODIuMXoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojRjRCMzgyOyIgZD0iTTMyNy45LDE3NS4yYzAtOTIuNC0zNS43LTExMy42LTc5LjgtMTEzLjZjLTQ0LDAtNzkuOCwyMS4yLTc5LjgsMTEzLjZjMCwzMS4zLDUuNiw1NS44LDE0LDc0LjcgIGMxOC40LDQxLjYsNTAuMyw1Ni4xLDY1LjgsNTYuMXM0Ny4zLTE0LjUsNjUuOC01Ni4xQzMyMi4zLDIzMSwzMjcuOSwyMDYuNSwzMjcuOSwxNzUuMnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQUY0QjE5OyIgZD0iTTI4OC43LDcxLjFDMjcyLjUsNTQsMjM3LDU4LjcsMjM3LDU4LjdsMCwwbDAsMGwwLDBjLTM1LjIsNC44LTc1LjksNzMuOS03NS45LDczLjlsLTEuMywyMC41ICAgYzAsMTQuMiw3LjYsMzEuOCwxNSw0OS4zYzAsMC0xLjUtNTcuNywzMy4xLTczLjFzOTIuMS0xMS43LDg5LjYtMjkuNEMyOTcuNCw5OSwyOTksODIuMSwyODguNyw3MS4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0FGNEIxOTsiIGQ9Ik0yNjkuOCw2MC4xYzEwLjYtNC45LDM1LjcsNy42LDQ4LjMsMjYuM2M2LjcsOS45LDE0LjUsMjUsMTcuMSw0Ni4yYzAsMCwwLjMsNDIuMy0xMC4yLDY4LjUgICBjMCwwLTMwLjItODcuMy02My4xLTEyNC42QzI2Miw3NiwyNjMsNjMuMywyNjkuOCw2MC4xeiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNjAuNywyMDcuN2M0LjMsMjUuMiw5LjYsMjYuMywxNy4zLDI1bC04LjEtNTQuOEMxNjIuMiwxNzkuMywxNTYuNCwxODIuNiwxNjAuNywyMDcuN3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGNEIzODI7IiBkPSJNMzI2LjUsMTc4bC04LjEsNTQuOGM3LjYsMS4zLDEzLDAuMSwxNy4zLTI1QzMzOS45LDE4Mi42LDMzNC4xLDE3OS4zLDMyNi41LDE3OHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojQ0M3ODVFOyIgZD0iTTI3NC44LDI2My44YzAsMC0xNC4yLDkuNi0yNi43LDkuNnMtMjYuNy05LjYtMjYuNy05LjZjMC0xLjQsMTEuMy01LjMsMTYuMS02ICBjMy0wLjUsMTAuNiwyLjUsMTAuNiwyLjVzNy41LTIuOSwxMC40LTIuNUMyNjMuNCwyNTguNSwyNzQuOCwyNjMuOCwyNzQuOCwyNjMuOHoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0MxNjk1MjsiIGQ9Ik0yNzQuOCwyNjMuOGMwLDAtMTQuMiwxMy41LTI2LjcsMTMuNXMtMjYuNy0xMy41LTI2LjctMTMuNXM2LjUsMS41LDE5LjYsMC43YzIuMi0wLjEsNS4xLDEuNiw3LDEuNiAgYzEuNywwLDQuMi0xLjgsNi4xLTEuN0MyNjcuOSwyNjUuMiwyNzQuOCwyNjMuOCwyNzQuOCwyNjMuOHoiLz4KPHJlY3QgeD0iMTYxIiB5PSI5My42IiBzdHlsZT0iZmlsbDojMjQyRDJCOyIgd2lkdGg9IjE3NC4xIiBoZWlnaHQ9IjM5Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxODFFMUQ7IiBkPSJNMjU3LjksMTI1LjdjLTUuNCwxLjYtMTQuMiwxLjYtMTkuNiwwTDExOC43LDg5LjFjLTIuOC0wLjgtNC4xLTItNC4xLTMuMXYtNC4xaDI2N2MwLDAsMCw0LjEsMCw0LjIgIGMwLDEuMS0xLjQsMi4yLTQuMSwzTDI1Ny45LDEyNS43eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMkEzNjMzOyIgZD0iTTI1Ny45LDEyMS41Yy01LjQsMS42LTE0LjIsMS42LTE5LjYsMEwxMTguNyw4NC45Yy01LjQtMS43LTUuNC00LjMsMC02bDExOS42LTM2LjYgIGM1LjQtMS43LDE0LjItMS43LDE5LjYsMGwxMTkuNiwzNi42YzUuNCwxLjcsNS40LDQuMywwLDZMMjU3LjksMTIxLjV6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjMuOCw5OWMtMC45LDAtMS42LDAuNy0xLjYsMS42djY1LjhjMCwwLjksMC43LDEuNiwxLjYsMS42czEuNi0wLjcsMS42LTEuNnYtNjUuOCAgIEMzMjUuNCw5OS43LDMyNC43LDk5LDMyMy44LDk5eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjQuMiw5OS4xbC02Ny45LTIxLjJjLTAuOS0wLjMtMS44LDAuMi0yLDEuMWMtMC4zLDAuOSwwLjIsMS44LDEuMSwybDY3LjksMjEuMiAgIGMwLjksMC4zLDEuOC0wLjIsMi0xLjFDMzI1LjYsMTAwLjIsMzI1LjEsOTkuMywzMjQuMiw5OS4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjguMiwxMzUuM2MwLDIuOC0yLDUuMS00LjUsNS4xcy00LjUtMi4zLTQuNS01LjFzMi01LjEsNC41LTUuMVMzMjguMiwxMzIuNSwzMjguMiwxMzUuM3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNCQzk5MkY7IiBkPSJNMzIyLjIsMTM5LjZjMCwwLTQuNSw1LjItNC41LDguM2MwLDEuMywwLDguNi0wLjEsMTMuOGMwLDMuMi0yLjQsNS43LTIuNCw1LjcgICBjMCwxLjgsMTYuOSwxLjgsMTYuOSwwYzAsMC0yLjQtMi40LTIuNC01LjVjMC01LjItMC4xLTEyLjMtMC4xLTEzLjhjMC0zLjQtNC41LTguNS00LjUtOC41SDMyMi4yeiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiMxODFFMUQ7IiBkPSJNMjU2LjksNzcuMWMwLDIuOS0zLjgsNS4yLTguNSw1LjJzLTguNS0yLjQtOC41LTUuMmMwLTIuOSwzLjgtNS4zLDguNS01LjMgIEMyNTMuMSw3MS44LDI1Ni45LDc0LjIsMjU2LjksNzcuMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="/>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <h6 class="font-weight-medium mb-0">{{ get_user_full_name() }}</h6>
                                    <small>Folio CENEVAL: {{ get_aspirante()->folio }}</small>
                                </div>

                            </div>
                        </div>
                    </div>



                @if(count($ofertas) > 0)
                    <div class=" card ">
                        <div class="row">
                            @foreach($ofertas as $oferta)




                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 ">

                                    <div id="crd" class="card text-center">


                                        <gmap-map
                                                ref="gmap"
                                                :center="{ lat: {{ $oferta->ofertaEducativa->plantel->latitud}}, lng: {{ $oferta->ofertaEducativa->plantel->longitud}} }"
                                                :zoom="17"
                                                style="width:100%;  height: 300px;"
                                        >

                                            <gmap-marker
                                                    :position="google && new google.maps.LatLng({{ $oferta->ofertaEducativa->plantel->latitud}}, {{ $oferta->ofertaEducativa->plantel->longitud}})"
                                            ></gmap-marker>


                                        </gmap-map>

                                        
                                        <div class="card-body" style="height: 14cm">
                                            <h2><span class="badge badge-pill badge-success">{{$oferta->preferencia}}</span></h2>
                                            <div style="height: 140px;">
                                                <p class="card-title text-primary"><b>{{ $oferta->ofertaEducativa->especialidad->referencia }}</b></p>
                                                <p class="card-text">{{ $oferta->ofertaEducativa->plantel->descripcion }}</p>
                                            </div>


                                            <hr>
                                            <p class="card-text" style="text-align: justify; ">
                                                <b>Descripcion:</b><br>{{ $oferta->ofertaEducativa->especialidad->descripcion}}
                                            </p>


                                        </div>
                                    </div>



                                </div>

                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

    </main>

@endsection

@section('extra-scripts')
    {{-- <script>
        function initMap() {
            var myLatLng = {lat: -25.363, lng: 131.044};

            var map = new google.maps.Map(document.getElementById('googleMap1'), {
                zoom: 4,
                center: myLatLng
            });


            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Hello World!'
            });
        }
    </script> --}}
    <script src="{{ mix('js/aspirante/profile.js') }}"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBalo_Mz03Pk3OvjRfT-16RPhTabln68w&callback=initMap"></script> --}}
@endsection

