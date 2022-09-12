<!-- extendendo layout padrão -->
@extends('layouts.default')

@section('content')

    {{-- {{ dd($product) }} --}}

    <section class="text-gray-600">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-2/4 w-full mx-auto overflow-auto">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-2xl font-medium title-font mb-2 text-gray-900">Editar produto</h1>
                </div>

                <form enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}" method="POST">
                    <!-- enctype="multipart/form-data": trabalhando com imagem -->

                    @csrf <!-- csrf: diretiva de segurança do laravel -->
                    @method('PUT') <!-- forçando método PUT (update) -->

                    <div class="flex flex-wrap">
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Nome do produto</label>
                                <input type="text" id="name" name="name"  value="{{ old('name', $product->name) }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <!-- old('pegando valor antigo(valor que está salvo no banco)', -->
                                    <!-- 'se não existir, imprimime o $product->name(que seria o valor atual que vou colocar)') -->
                                </div>
                            @error('name') <!-- se houver erro, exibe tudo que está aqui dentro -->
                                <div class="text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Preço</label>
                                <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    <!-- old('pegando valor antigo(valor que está salvo no banco)', -->
                                    <!-- 'se não existir, imprimime o $product->price(que seria o valor atual que vou colocar)') -->
                                </div>
                            @error('price') <!-- se houver erro, exibe tudo que está aqui dentro -->
                                <div class="text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Estoque</label>
                                <input type="text" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <!-- old('pegando valor antigo(valor que está salvo no banco)', -->
                                    <!-- 'se não existir, imprimime o $product->stock(que seria o valor atual que vou colocar)') -->
                                </div>
                            @error('stock') <!-- se houver erro, exibe tudo que está aqui dentro -->
                                <div class="text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Imagem de capa</label>
                                <input type="file" id="cover" name="cover"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                            @error('cover') <!-- se houver erro, exibe tudo que está aqui dentro -->
                                <div class="text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- só vou mostrar este bloco quando tiver imagem -->
                        @if ($product->cover)
                            <div class="p-2 w-full">

                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->cover) }}" alt="">
                                <!-- \Illuminate\Support\Facades\Storage::url($product->cover): necessário para mostrar a imagem -->

                                <a href="{{ route('admin.product.destroyImage', $product->id) }}">Deletar imagem</a>

                            </div>
                        @endif

                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Descrição</label>
                                <textarea
                                    id="description" name="description"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description', $product->description) }}</textarea>
                                    <!-- old('pegando valor antigo(valor que está salvo no banco)', -->
                                    <!-- 'se não existir, imprimime o $product->description(que seria o valor atual que vou colocar)') -->
                                </div>
                            @error('description') <!-- se houver erro, exibe tudo que está aqui dentro -->
                                <div class="text-red-400 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="p-2 w-full">
                            <button type="submit" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Editar</button>
                            <!-- type="submit": para enviar o formulário -->
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
