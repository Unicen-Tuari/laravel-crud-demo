<x-tasks>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-gray-900">Crear tarea</h3>

      <p class="mt-1 text-sm text-gray-600">
          Asegurate de incluir un nombre y descripción representativo.
      </p>
        </div>
    </div>
          

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method='POST' action="{{ route('tasks.store') }}">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="name">
                                  Nombre
                              </label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="{{ old('name') }}" >
                            @error('name')
                              <div class="text-red-600">{{ $message }}</div> 
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="description">
                                  Descripción
                              </label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="description" name="description" type="text" value="{{ old('description') }}" >
                            @error('description')
                              <div class="text-red-600">{{ $message }}</div> 
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="description">
                                  Asignación
                              </label>
                              <div class="inline-block relative w-64">
                                <select name="assigned_to" id="assigned_to" required
                                  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option disabled selected>Seleccione un usuario</option>
                                    @foreach($users as $user)
                                      <option value="{{$user->id}}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                              </div>
                            @error('assigned_to')
                              <div class="text-red-600">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                      Crear Tarea
                  </button>
                </div>
            </div>
        </form>
    </div>
</x-tasks>