<div data-id="{{$id}}" class="flex flex-row notification-card <?php if ($read) echo "bg-slate-100"; else echo "bg-cyan-200"; ?>">
    <p>
        {{$description}}
    </p> 
    <img src="/icons/delete.svg" alt="delete icon" width=18 height=18 class="block bg-red-500 rounded-xl w-5 h-5">
</div>