<div data-id="{{$id}}" class="flex flex-row justify-between items-center gap-x-4 p-2 m-2 cursor-pointer rounded-md <?php if ($read) echo "bg-slate-100"; else echo "bg-cyan-200"; ?>">
    <p>
        {{$description}}
    </p>
    <div class="p-1 bg-red-500 rounded-md flex-shrink-0">
        <img src="/icons/delete.svg" alt="delete icon" width=18 height=18 class="w-6 h-6">
    </div>
</div>