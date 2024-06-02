<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Laravel</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="w-screen h-screen">
            <div class="w-screen h-1/6 flex items-center justify-between font-bold text-lg bg-[#186adc] uppercase text-white p-12">
                <div></div>
                <span>
                    Cadastro Pessoas
                </span>                
                <button id="openModalBtn" class="border-2 border-black/30 hover:border-black hover:bg-black/50  text-white w-40 h-12 rounded-md uppercase">Nova Pessoa</button>
            </div>
            <div class="w-screen h-5/6 flex items-center gap-6 justify-start flex-col bg-[#1859b4] p-12">
                @foreach($users as $user)
                <div class="w-[720px] h-36 bg-white rounded-md flex flex-row p-4 items-center justify-between">
                    <div>
                        <p><span class="font-bold pr-4">Nome:</span>{{$user -> nome}}</p>
                        <p><span class="font-bold pr-4">Idade:</span>{{$user -> idade}}</p>
                        <p><span class="font-bold pr-4">Email:</span>{{$user -> email}}</p>
                        <p><span class="font-bold pr-2">Cidade:</span>{{$user -> cidade}}</p>
                    </div>
                    <div class="flex gap-4">
                        <a class="openEditModalBtn" href="#" data-user-id="{{ $user->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                        <a class="deleteBtn" data-delete-id="{{ $user->id }}"> 
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="myModalCreate" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg w-11/12 md:w-1/3">
                <span class="close float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <form action="{{route('user-store')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome:</label>
                        <input type="text" id="nome" name="nome" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                        <input type="email" id="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="cidade" class="block text-gray-700 font-semibold mb-2">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="idade" class="block text-gray-700 font-semibold mb-2">Idade:</label>
                        <input type="number" id="idade" name="idade" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="text-center">
                        <input type="submit" value="Enviar" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 cursor-pointer">
                    </div>
                </form>
            </div>
        </div>

        <div id="myModalEdit" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg w-11/12 md:w-1/3">
                <span class="close float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome:</label>
                        <input type="text" id="nomeUsuario" name="nome" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                        <input type="email" id="emailUsuario" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="cidade" class="block text-gray-700 font-semibold mb-2">Cidade:</label>
                        <input type="text" id="cidadeUsuario" name="cidade" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label for="idade" class="block text-gray-700 font-semibold mb-2">Idade:</label>
                        <input type="number" id="idadeUsuario" name="idade" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="text-center">
                        <input type="submit" value="Enviar" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 cursor-pointer">
                    </div>
                </form>
            </div>
        </div>

        <script>
             $(document).ready(function(){
                $("#openModalBtn").click(function(){
                    $("#myModalCreate").removeClass("hidden").addClass("flex");
                });

                $(".close").click(function(){
                    $("#myModalCreate").removeClass("flex").addClass("hidden");
                    $("#myModalEdit").removeClass("flex").addClass("hidden");
                });

                $(window).click(function(event){
                    if ($(event.target).is("#myModalCreate")) {
                        $("#myModalCreate").removeClass("flex").addClass("hidden");
                    }

                    if ($(event.target).is("#myModalEdit")) {
                        $("#myModalEdit").removeClass("flex").addClass("hidden");
                    }
                });

                $('.openEditModalBtn').click(function() {
                var userId = $(this).data('user-id');
                var url = `{{ route('user-update', ['id' => ':id']) }}`.replace(':id', userId);
                $.ajax({
                    url: `${userId}/edit`,
                    method: 'GET',
                    success: function(response) {
                        $('#nomeUsuario').val(response.nome);
                        $('#emailUsuario').val(response.email);
                        $('#cidadeUsuario').val(response.cidade);
                        $('#idadeUsuario').val(response.idade);
                        $('#editForm').attr('action', url);
                        $("#myModalEdit").removeClass("hidden").addClass("flex");
                    },
                    error: function() {
                        alert('User not found');
                    }
                });
                });

                $('.deleteBtn').click(function() {
                var userId = $(this).data('delete-id');
                var url = `{{ route('user-destroy', ['id' => ':id']) }}`.replace(':id', userId);
                $('#deleteForm').attr('action', url);
                });
            });
        </script>
    </body>
</html>
