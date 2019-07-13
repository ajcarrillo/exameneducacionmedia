@extends('aspirante.layouts.aspirante')

@section('extra-css')
    <style>
        .call-to-action li {
            padding-bottom: 1rem;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"/>
@endsection

@section('content')
    <main>
        <div class="container-fluid py-4" style="background-color: RGBA(248, 249, 250, 1.00)">
            <div class="row">
                <div class="col">
                    @include('flash::message')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-7 mb-lg-0">
                    <div class="card shadow-none border">
                        <div class="card-body text-center pb-0">
                            <div class="mb-3">
                                @if(get_aspirante()->sexo == 'H')
                                    <img class="rounded-circle" style="max-width: 100px"
                                         src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzMzNzE4MDsiIGQ9Ik0yNDguMSw0OTYuMmM3MC4yLDAsMTMzLjYtMjkuMiwxNzguNy03NmMtMi44LTE1LjEtNS42LTI4LjktOC4zLTM3LjQgIGMtOC41LTI3LjMtODEuMi00OS4zLTE3MC44LTQ5LjNzLTE2MS41LDIyLTE3MCw0OS4zYy0yLjYsOC41LTUuNSwyMi4yLTguMywzNy40QzExNC41LDQ2NywxNzcuOSw0OTYuMiwyNDguMSw0OTYuMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0yOTMuOSwzMzYuMmMtMTQuNS0xLjgtMzAtMi43LTQ2LjEtMi43Yy0xNS45LDAtMzEuMiwwLjktNDUuNSwyLjdsNDUuOCw5MUwyOTMuOSwzMzYuMnoiLz4KPHJlY3QgeD0iMjA1LjEiIHk9IjMyNC45IiBzdHlsZT0iZmlsbDojREVFMEUyOyIgd2lkdGg9Ijg2IiBoZWlnaHQ9IjI1Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNFMkEzNzk7IiBkPSJNMjQ4LjEsNDEyLjFsLTM3LjgtNzYuOGMwLDAsOS4yLTEyLjQsMzcuNC0xMi40czM4LjEsMTIuNSwzOC4xLDEyLjVMMjQ4LjEsNDEyLjF6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0xNjguMSwzNTcuMmwzNy0zMi4zbDMyLDYzLjljMCwwLTI1LjIsNy4xLTI1LjUsNi44TDE2OC4xLDM1Ny4yeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0zMjguMSwzNTcuMmwtMzctMzIuM2wtMzIsNjMuOWMwLDAsMjUuMiw3LjEsMjUuNSw2LjhMMzI4LjEsMzU3LjJ6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yODcsMjgyLjFoLTc3LjhjMTIuMSwzNi42LDEsNTMuMywxLDUzLjNzMTYuOSw2LjEsMzcuOSw2LjFzMzcuOS02LjEsMzcuOS02LjEgIFMyNzQuOSwzMTguNywyODcsMjgyLjF6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGNEIzODI7IiBkPSJNMzM2LjQsMTc1LjJjMC05Mi40LTM5LjUtMTEzLjYtODguMy0xMTMuNmMtNDguNywwLTg4LjMsMjEuMi04OC4zLDExMy42YzAsMzEuMyw2LjIsNTUuOCwxNS41LDc0LjcgIGMyMC40LDQxLjYsNTUuNyw1Ni4xLDcyLjgsNTYuMXM1Mi40LTE0LjUsNzIuOC01Ni4xQzMzMC4yLDIzMSwzMzYuNCwyMDYuNSwzMzYuNCwxNzUuMnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMTkxOTE5OyIgZD0iTTI0Ny42LDI5Mi45aDAuNUMyNDcuOSwyOTIuOSwyNDcuOCwyOTIuOSwyNDcuNiwyOTIuOUwyNDcuNiwyOTIuOXoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMxOTE5MTk7IiBkPSJNMjQ4LjYsMjkyLjlMMjQ4LjYsMjkyLjljLTAuMiwwLTAuMywwLTAuNSwwSDI0OC42eiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNzAuNCwyMzguN2MtOC40LDEuNC0xNC40LDAuMS0xOS4xLTI3LjdzMS43LTMxLjUsMTAuMS0zMi45TDE3MC40LDIzOC43eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0zMjUuOSwyMzguN2M4LjQsMS40LDE0LjMsMC4xLDE5LjEtMjcuN2M0LjgtMjcuOC0xLjctMzEuNS0xMC4xLTMyLjlMMzI1LjksMjM4Ljd6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6I0U1QTE3MzsiIGQ9Ik0yNzQuOCwyNTdjMCwyLjYtMTEuOSw5LjUtMjYuNyw5LjVzLTI2LjctNy0yNi43LTkuNWMwLTEuNiw4LjUtNi4xLDE0LjEtNi45ICBjMy42LTAuNSwxMi41LDIuOSwxMi41LDIuOXM4LjgtMy40LDEyLjQtMi45QzI2Ni4yLDI1MC45LDI3NC44LDI1NywyNzQuOCwyNTd6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNEODkzNjQ7IiBkPSJNMjc0LjgsMjU3YzAsMi42LTExLjksMTIuNC0yNi43LDEyLjRzLTI2LjctOS45LTI2LjctMTIuNGMwLDAsMTAuOSwxLjMsMjYuNywxLjMgIFMyNzQuOCwyNTcsMjc0LjgsMjU3eiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiM3NzNBMjM7IiBkPSJNMzM2LjQsMTc1LjJjMC05Mi40LTMwLjMtMTE2LjEtODguMy0xMTYuMXMtODguMywyMy43LTg4LjMsMTE2LjFsMzkuOC0zMy4xYzAsMCwyNi41LDAsNDguNSwwICAgczQ2LjItMzUuMyw0Ni4yLTM1LjNMMzM2LjQsMTc1LjJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNzczQTIzOyIgZD0iTTMzMC44LDE0MC44YzQuMiwxMC45LDUuNiwyNC40LDUuNiwzNy41YzAsMC04LjgtMS45LTguOCwyLjZsLTIuOCwyNy42bC0zLjktMS45ICAgYzAuMi0yMy00LjktNjYuMi00LjktNjYuMkwzMzAuOCwxNDAuOHoiLz4KPC9nPgo8cmVjdCB4PSIxNjEiIHk9IjkzLjYiIHN0eWxlPSJmaWxsOiMyNDJEMkI7IiB3aWR0aD0iMTc0LjEiIGhlaWdodD0iMzkiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzE4MUUxRDsiIGQ9Ik0yNTcuOSwxMjUuN2MtNS40LDEuNi0xNC4yLDEuNi0xOS42LDBMMTE4LjcsODkuMWMtMi44LTAuOC00LjEtMi00LjEtMy4xdi00LjFoMjY3YzAsMCwwLDQuMSwwLDQuMiAgYzAsMS4xLTEuNCwyLjItNC4xLDNMMjU3LjksMTI1Ljd6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMyQTM2MzM7IiBkPSJNMjU3LjksMTIxLjVjLTUuNCwxLjYtMTQuMiwxLjYtMTkuNiwwTDExOC43LDg0LjljLTUuNC0xLjctNS40LTQuMywwLTZsMTE5LjYtMzYuNiAgYzUuNC0xLjcsMTQuMi0xLjcsMTkuNiwwbDExOS42LDM2LjZjNS40LDEuNyw1LjQsNC4zLDAsNkwyNTcuOSwxMjEuNXoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyMy44LDk5Yy0wLjksMC0xLjYsMC43LTEuNiwxLjZ2NjUuOGMwLDAuOSwwLjcsMS42LDEuNiwxLjZzMS42LTAuNywxLjYtMS42di02NS44ICAgQzMyNS40LDk5LjcsMzI0LjcsOTksMzIzLjgsOTl6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyNC4yLDk5LjFsLTY3LjktMjEuMmMtMC45LTAuMy0xLjgsMC4yLTIsMS4xYy0wLjMsMC45LDAuMiwxLjgsMS4xLDJsNjcuOSwyMS4yICAgYzAuOSwwLjMsMS44LTAuMiwyLTEuMUMzMjUuNiwxMDAuMiwzMjUuMSw5OS4zLDMyNC4yLDk5LjF6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQkM5OTJGOyIgZD0iTTMyOC4yLDEzNS4zYzAsMi44LTIsNS4xLTQuNSw1LjFzLTQuNS0yLjMtNC41LTUuMXMyLTUuMSw0LjUtNS4xUzMyOC4yLDEzMi41LDMyOC4yLDEzNS4zeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjIuMiwxMzkuNmMwLDAtNC41LDUuMi00LjUsOC4zYzAsMS4zLDAsOC42LTAuMSwxMy44YzAsMy4yLTIuNCw1LjctMi40LDUuNyAgIGMwLDEuOCwxNi45LDEuOCwxNi45LDBjMCwwLTIuNC0yLjQtMi40LTUuNWMwLTUuMi0wLjEtMTIuMy0wLjEtMTMuOGMwLTMuNC00LjUtOC41LTQuNS04LjVIMzIyLjJ6Ii8+CjwvZz4KPHBhdGggc3R5bGU9ImZpbGw6IzE4MUUxRDsiIGQ9Ik0yNTYuOSw3Ny4xYzAsMi45LTMuOCw1LjItOC41LDUuMnMtOC41LTIuNC04LjUtNS4yYzAtMi45LDMuOC01LjMsOC41LTUuMyAgQzI1My4xLDcxLjgsMjU2LjksNzQuMiwyNTYuOSw3Ny4xeiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojNzczQTIzOyIgZD0iTTE2NS41LDE0MC44Yy00LjIsMTAuOS01LjYsMjQuNC01LjYsMzcuNWMwLDAsOC44LTEuOSw4LjgsMi42bDIuOCwyNy42bDMuOS0xLjkgIGMtMC4yLTIzLDQuOS02OCw0LjktNjhMMTY1LjUsMTQwLjh6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zMTEuNSwzMzcuNEwzMTEuNSwzMzcuNEwzMTEuNSwzMzcuNEwzMTEuNSwzMzcuNHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMjk4LjUsMzM1LjlMMjk4LjUsMzM1LjlMMjk4LjUsMzM1Ljl6Ii8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="/>
                                @elseif(get_aspirante()->sexo == 'M')
                                    <img class="rounded-circle" style="max-width: 100px"
                                         src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0OTYuMiA0OTYuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDk2LjIgNDk2LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojQTNENUUwOyIgZD0iTTQ5Ni4yLDI0OC4xQzQ5Ni4yLDExMS4xLDM4NS4xLDAsMjQ4LjEsMFMwLDExMS4xLDAsMjQ4LjFzMTExLjEsMjQ4LjEsMjQ4LjEsMjQ4LjEgIFM0OTYuMiwzODUuMSw0OTYuMiwyNDguMXoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTJBMzc5OyIgZD0iTTI4NywyODIuMWgtNzcuOGMxMi4xLDM2LjYsMSw1My4zLDEsNTMuM2wyNi45LDYuMWgyMmwyNi45LTYuMUMyODYsMzM1LjQsMjc0LjksMzE4LjcsMjg3LDI4Mi4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDguMiwzOTAuMWM0NC45LDAsMzcuOC01NC43LDM3LjgtNTQuN3MtOC45LDE3LjMtMzguMSwxNy4zcy0zNy41LTE3LjMtMzcuNS0xNy4zICAgUzIwMy4zLDM5MC4xLDI0OC4yLDM5MC4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDcuOCwzMzMuNGMtNzcuMiwwLTEzOS4xLDIyLjEtMTQ2LjQsNDkuM2MtMy4zLDEyLjItNywzNS4yLTEwLjEsNTcuNSAgIGM0Mi43LDM0LjksOTcuNCw1NS45LDE1Ni45LDU1LjlzMTE0LjEtMjEsMTU2LjktNTUuOWMtMy4yLTIyLjMtNi45LTQ1LjQtMTAuMS01Ny41QzM4Ny41LDM1NS41LDMyNC45LDMzMy40LDI0Ny44LDMzMy40eiIvPgo8L2c+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNBRjRCMTk7IiBwb2ludHM9IjM0OS4xLDQwOC4xIDE0Ny4xLDQwOC4xIDE1OS44LDE1My4xIDMzNS4yLDEzMi42ICIvPgo8cmVjdCB4PSIyMDUuMSIgeT0iMzI0LjkiIHN0eWxlPSJmaWxsOiNERUUwRTI7IiB3aWR0aD0iODYiIGhlaWdodD0iMjUiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzMzNzE4MDsiIGQ9Ik0yNDcuOCwzMzMuNGMtNzcuMiwwLTEzOS4xLDIyLjEtMTQ2LjQsNDkuM2MtMy4zLDEyLjItNywzNS4yLTEwLjEsNTcuNSAgYzQyLjcsMzQuOSw5Ny40LDU1LjksMTU2LjksNTUuOXMxMTQuMS0yMSwxNTYuOS01NS45Yy0zLjItMjIuMy02LjktNDUuNC0xMC4xLTU3LjVDMzg3LjUsMzU1LjUsMzI0LjksMzMzLjQsMjQ3LjgsMzMzLjR6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0YzRkFGRjsiIGQ9Ik0yOTMuOSwzMzYuMmMtMTQuNS0xLjgtMzAtMi43LTQ2LjEtMi43Yy0xNS45LDAtMzEuMiwwLjktNDUuNSwyLjdsNDUuOCw5MUwyOTMuOSwzMzYuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGM0ZBRkY7IiBkPSJNMTY4LjEsMzU3LjJsMzctMzIuM2wzMiw2My45YzAsMC0yNS4yLDcuMS0yNS41LDYuOEwxNjguMSwzNTcuMnoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGM0ZBRkY7IiBkPSJNMzI4LjEsMzU3LjJsLTM3LTMyLjNsLTMyLDYzLjljMCwwLDI1LjIsNy4xLDI1LjUsNi44TDMyOC4xLDM1Ny4yeiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0UyQTM3OTsiIGQ9Ik0yNDguMSw0MTIuMWwtMzcuOC03Ni44YzAsMCw5LjItMTIuNCwzNy40LTEyLjRzMzguMSwxMi41LDM4LjEsMTIuNUwyNDguMSw0MTIuMXoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNFMkEzNzk7IiBkPSJNMjg3LDI4Mi4xaC03Ny44YzEyLjEsMzYuNiwxLDUzLjMsMSw1My4zczE2LjQsNi4xLDM3LjksNi4xczM3LjktNi4xLDM3LjktNi4xICAgUzI3NC45LDMxOC43LDI4NywyODIuMXoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojRjRCMzgyOyIgZD0iTTMyNy45LDE3NS4yYzAtOTIuNC0zNS43LTExMy42LTc5LjgtMTEzLjZjLTQ0LDAtNzkuOCwyMS4yLTc5LjgsMTEzLjZjMCwzMS4zLDUuNiw1NS44LDE0LDc0LjcgIGMxOC40LDQxLjYsNTAuMyw1Ni4xLDY1LjgsNTYuMXM0Ny4zLTE0LjUsNjUuOC01Ni4xQzMyMi4zLDIzMSwzMjcuOSwyMDYuNSwzMjcuOSwxNzUuMnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQUY0QjE5OyIgZD0iTTI4OC43LDcxLjFDMjcyLjUsNTQsMjM3LDU4LjcsMjM3LDU4LjdsMCwwbDAsMGwwLDBjLTM1LjIsNC44LTc1LjksNzMuOS03NS45LDczLjlsLTEuMywyMC41ICAgYzAsMTQuMiw3LjYsMzEuOCwxNSw0OS4zYzAsMC0xLjUtNTcuNywzMy4xLTczLjFzOTIuMS0xMS43LDg5LjYtMjkuNEMyOTcuNCw5OSwyOTksODIuMSwyODguNyw3MS4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0FGNEIxOTsiIGQ9Ik0yNjkuOCw2MC4xYzEwLjYtNC45LDM1LjcsNy42LDQ4LjMsMjYuM2M2LjcsOS45LDE0LjUsMjUsMTcuMSw0Ni4yYzAsMCwwLjMsNDIuMy0xMC4yLDY4LjUgICBjMCwwLTMwLjItODcuMy02My4xLTEyNC42QzI2Miw3NiwyNjMsNjMuMywyNjkuOCw2MC4xeiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0Y0QjM4MjsiIGQ9Ik0xNjAuNywyMDcuN2M0LjMsMjUuMiw5LjYsMjYuMywxNy4zLDI1bC04LjEtNTQuOEMxNjIuMiwxNzkuMywxNTYuNCwxODIuNiwxNjAuNywyMDcuN3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGNEIzODI7IiBkPSJNMzI2LjUsMTc4bC04LjEsNTQuOGM3LjYsMS4zLDEzLDAuMSwxNy4zLTI1QzMzOS45LDE4Mi42LDMzNC4xLDE3OS4zLDMyNi41LDE3OHoiLz4KPC9nPgo8cGF0aCBzdHlsZT0iZmlsbDojQ0M3ODVFOyIgZD0iTTI3NC44LDI2My44YzAsMC0xNC4yLDkuNi0yNi43LDkuNnMtMjYuNy05LjYtMjYuNy05LjZjMC0xLjQsMTEuMy01LjMsMTYuMS02ICBjMy0wLjUsMTAuNiwyLjUsMTAuNiwyLjVzNy41LTIuOSwxMC40LTIuNUMyNjMuNCwyNTguNSwyNzQuOCwyNjMuOCwyNzQuOCwyNjMuOHoiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0MxNjk1MjsiIGQ9Ik0yNzQuOCwyNjMuOGMwLDAtMTQuMiwxMy41LTI2LjcsMTMuNXMtMjYuNy0xMy41LTI2LjctMTMuNXM2LjUsMS41LDE5LjYsMC43YzIuMi0wLjEsNS4xLDEuNiw3LDEuNiAgYzEuNywwLDQuMi0xLjgsNi4xLTEuN0MyNjcuOSwyNjUuMiwyNzQuOCwyNjMuOCwyNzQuOCwyNjMuOHoiLz4KPHJlY3QgeD0iMTYxIiB5PSI5My42IiBzdHlsZT0iZmlsbDojMjQyRDJCOyIgd2lkdGg9IjE3NC4xIiBoZWlnaHQ9IjM5Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiMxODFFMUQ7IiBkPSJNMjU3LjksMTI1LjdjLTUuNCwxLjYtMTQuMiwxLjYtMTkuNiwwTDExOC43LDg5LjFjLTIuOC0wLjgtNC4xLTItNC4xLTMuMXYtNC4xaDI2N2MwLDAsMCw0LjEsMCw0LjIgIGMwLDEuMS0xLjQsMi4yLTQuMSwzTDI1Ny45LDEyNS43eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojMkEzNjMzOyIgZD0iTTI1Ny45LDEyMS41Yy01LjQsMS42LTE0LjIsMS42LTE5LjYsMEwxMTguNyw4NC45Yy01LjQtMS43LTUuNC00LjMsMC02bDExOS42LTM2LjYgIGM1LjQtMS43LDE0LjItMS43LDE5LjYsMGwxMTkuNiwzNi42YzUuNCwxLjcsNS40LDQuMywwLDZMMjU3LjksMTIxLjV6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjMuOCw5OWMtMC45LDAtMS42LDAuNy0xLjYsMS42djY1LjhjMCwwLjksMC43LDEuNiwxLjYsMS42czEuNi0wLjcsMS42LTEuNnYtNjUuOCAgIEMzMjUuNCw5OS43LDMyNC43LDk5LDMyMy44LDk5eiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjQuMiw5OS4xbC02Ny45LTIxLjJjLTAuOS0wLjMtMS44LDAuMi0yLDEuMWMtMC4zLDAuOSwwLjIsMS44LDEuMSwybDY3LjksMjEuMiAgIGMwLjksMC4zLDEuOC0wLjIsMi0xLjFDMzI1LjYsMTAwLjIsMzI1LjEsOTkuMywzMjQuMiw5OS4xeiIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0JDOTkyRjsiIGQ9Ik0zMjguMiwxMzUuM2MwLDIuOC0yLDUuMS00LjUsNS4xcy00LjUtMi4zLTQuNS01LjFzMi01LjEsNC41LTUuMVMzMjguMiwxMzIuNSwzMjguMiwxMzUuM3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNCQzk5MkY7IiBkPSJNMzIyLjIsMTM5LjZjMCwwLTQuNSw1LjItNC41LDguM2MwLDEuMywwLDguNi0wLjEsMTMuOGMwLDMuMi0yLjQsNS43LTIuNCw1LjcgICBjMCwxLjgsMTYuOSwxLjgsMTYuOSwwYzAsMC0yLjQtMi40LTIuNC01LjVjMC01LjItMC4xLTEyLjMtMC4xLTEzLjhjMC0zLjQtNC41LTguNS00LjUtOC41SDMyMi4yeiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiMxODFFMUQ7IiBkPSJNMjU2LjksNzcuMWMwLDIuOS0zLjgsNS4yLTguNSw1LjJzLTguNS0yLjQtOC41LTUuMmMwLTIuOSwzLjgtNS4zLDguNS01LjMgIEMyNTMuMSw3MS44LDI1Ni45LDc0LjIsMjU2LjksNzcuMXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="/>
                                @endif
                            </div>
                            <div class="">
                                <h6 class="font-weight-medium mb-0">{{ get_user_full_name() }}</h6>
                                <small>Folio CENEVAL: {{ get_aspirante()->folio }}</small>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            @include('aspirante.partials.call_actions_list')
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="callout callout-info">
                        <h5>¡ATENCIÓN!</h5>
                        El registro es únicamente para que obtengas tu pase al examen.
                        Los espacios se asignarán tomando en cuenta los aciertos obtenidos en el examen de admisión, y al orden seleccionado de acuerdo a la preferencia de plantel,
                        habiéndose verificado la capacidad de espacios de cada uno de los planteles públicos.
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h1 class="card-title">Información</h1>
                        </div>
                        @if($asignacionesPublicadas)
                            @if($hasAsignacion)
                                <div class="card-body">
                                    <h3>¡FELICIDADES {{ Auth::user()->nombre }}!</h3>
                                    <h4>¡Fuiste asignado en tu opción {{ get_numero_opcion() }}!</h4>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Subsistema</th>
                                                <th>Plantel</th>
                                                <th>Especialidad</th>
                                                <th>Descargar reporte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ get_aspirante()->asignacion->ofertaEducativa->plantel->subsistema->referencia }}</td>
                                                <td>{{ get_aspirante()->asignacion->ofertaEducativa->plantel->descripcion }}</td>
                                                <td>{{ get_aspirante()->asignacion->ofertaEducativa->especialidad->referencia }}</td>
                                                <td>
                                                    <a href="{{ route('aspirante.descargar.reporte.individual') }}" class="btn btn-link">
                                                        Descargar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="card-body">
                                    <h4>¡Hola {{ Auth::user()->nombre }}!</h4>
                                    <p>No fuiste asignado a ningún plantel.</p>
                                    <p>Preséntate a alguno de los Servicios Educativos de los municipios listados en la tabla siguiente:</p><br/>
                                    <img src="{{ asset('img/enlaces.png') }}" alt="Enlaces" class="img-fluid">
                                </div>
                            @endif
                        @else
                            <div class="card-body">
                                @if($hasRevision)
                                    @if(!$revision->efectuado)
                                        <div class="alert alert-success" role="alert">
                                            Descarga tu ficha de pago, paga en banco y espera 72hrs para ver reflejado tu depósito.
                                        </div>
                                    @else
                                        @if(!$hasPaseAlExamen)
                                            <div class="alert alert-success" role="alert">
                                                Genera tu pase al examen
                                            </div>
                                        @else
                                            <div class="alert alert-success" role="alert">
                                                <strong>¡ HAS FINALIZADO TU REGISTRO !</strong>
                                                Tu pase al examen ha sido generado correctamente, ahora procede a descargar tu pase al examen
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <h4>Pasos a seguir para obtener tu pase al examen.</h4>

                                <ol>
                                    <li>
                                        <strong>Editar perfil:</strong> Responde cada pregunta, guarda todos los datos y da clic en “REGRESAR” al portal de bienvenido para
                                        continuar.
                                    </li>
                                    <li>
                                        <strong>Cuestionario Ceneval:</strong> Responde cada pregunta de las 3 páginas, da siguiente y guarda todos los datos, hasta que el
                                        sistema
                                        indique “El cuestionario ceneval, fue respondido exitosamente” da clic en “REGRESAR”.
                                    </li>
                                    <li>
                                        <strong>Opciones Educativas:</strong> Inicia seleccionando el municipio donde se encuentra el plantel donde quieres estudiar, la
                                        localidad,
                                        plantel, especialidad y agrega. Así lo harás con cada opción a elegir, hasta que hayan sido la cantidad de opciones que indica en
                                        opciones a
                                        elegir “GUARDA” y “REGRESA” da clic en “ENVIAR REGISTRO” ( si no aparece esta opción, te hace falta información de las pasos 1 y 2, o
                                        ambas).
                                    </li>
                                </ol>
                                <p><strong>**Genera y descarga tu boleta pago de derecho a examen.</strong></p>

                                Después del pago efectuado, de 2 a 3 días hábiles, ingresa al portal de registro <a href="http://paenms.seq.gob.mx">http://paenms.seq.gob.mx</a>
                                y
                                entra
                                con tu usuario, que es el correo electrónico que diste de alta, cuando creaste tu cuenta PAENMS, para descargar e imprimir el pase al examen,
                                esté
                                indicará el plantel, fecha, hora y aula del día del examen.

                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @if(count($ofertas) > 0)
                    <div class="col">
                        <div class="card">
                            <div id="map" style="width: 100%; height: 400px; border: 1px solid grey" data-datos="{{$ofertas_gral}}"></div>
                            <div class="row p-3">
                                @foreach($ofertas as $oferta)
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 d-flex">
                                        <div class="card text-center align-self-stretch">
                                            <iframe width="100%" height="350" frameborder="0" scrolling="no"
                                                    marginheight="0" marginwidth="0"
                                                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $oferta->ofertaEducativa->plantel->longitud + .0009}}%2C{{ $oferta->ofertaEducativa->plantel->latitud + .0009}}%2C{{ $oferta->ofertaEducativa->plantel->longitud}}%2C{{ $oferta->ofertaEducativa->plantel->latitud}}&amp;layer=mapnik&amp;marker={{ $oferta->ofertaEducativa->plantel->latitud}}%2C{{ $oferta->ofertaEducativa->plantel->longitud}}"
                                            ></iframe>
                                            <div class="card-body">
                                                <h2>
                                                    <span class="badge badge-pill badge-success">{{$oferta->preferencia}}</span>
                                                </h2>
                                                <div>
                                                    <p class="card-title text-primary">
                                                        <b>{{ $oferta->ofertaEducativa->especialidad->referencia }}</b></p>
                                                    <p class="card-text">{{ $oferta->ofertaEducativa->plantel->descripcion }}</p>
                                                </div>
                                                <hr>
                                                <p class="card-text text-justify">
                                                    <b>Descripcion:</b><br>{{ $oferta->ofertaEducativa->especialidad->descripcion}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>


    </main>

@endsection

@section('extra-scripts')
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="{{ mix('js/aspirante/dashboard.js') }}"></script>
@endsection

