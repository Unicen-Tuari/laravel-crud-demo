<x-tasks>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-gray-900">Modificar tarea</h3>

      <p class="mt-1 text-sm text-gray-600">
          Asegurate de incluir un nombre y descripción representativo.
      </p>
        </div>
    </div>


    <div class="mt-5 md:mt-0 md:col-span-2">
        @if (session('success'))
        <div class="mb-6 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-bold">{{ session('success') }}</p>
          </div>
        </div>
      </div>
        @endif
        <form method='POST' action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="name">
                                  Nombre
                              </label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="{{ old('name') ?? $task->name }}" >
                            @error('name')
                              <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="description">
                                  Descripción
                              </label>
                            <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="description" name="description" type="text" value="{{ old('description') ?? $task->description }}" >
                            @error('description')
                              <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        @can('assign', App\Models\Task::class)
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="description">
                                  Asignación
                              </label>
                              <div class="inline-block relative w-64">
                                <select name="assigned_to" id="assigned_to" required
                                  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option disabled @if(!$task->assignee) selected @endif>Seleccione un usuario</option>
                                    @foreach($users as $user)
                                      <option value="{{$user->id}}" @if($task->assignee && $task->assignee->id === $user->id) selected @endif>{{ $user->name }}</option>
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
                        @endcan
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="description">
                                  Estado
                              </label>
                              <label class="flex items-center">
                              <input type="checkbox" name="done" class="form-checkbox" @if(old('done') || $task->done) checked @endif >
                              <span class="ml-2 text-sm text-gray-600">Hecho</span>
                          </label>
                          @error('done')
                            <div class="text-red-600">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                      Editar Tarea
                  </button>
                </div>
            </div>
        </form>
    </div>
</x-tasks>

