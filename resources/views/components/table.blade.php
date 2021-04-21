@props(['headers', 'canSelectMultiple' => false])

<div class="flex flex-col">
    <loading :show="loading"></loading>
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        {{ $filter ?? '' }}

        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full text-xs">
                <thead>
                    <tr class="text-center">
                        @if($canSelectMultiple)
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                <input type="checkbox" class="inline-flex duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none mx-auto my-3 rounded shadow-sm transition" @change="selectAllHandler">
                            </th>
                        @endif
                        @foreach($headers as $header)
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                {{__($header)}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white">
                    
                    {{ $body }}
                    
                </tbody>
            </table>
        </div>
    </div>
</div>