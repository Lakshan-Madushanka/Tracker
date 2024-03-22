@php use Illuminate\Support\Str; @endphp

<div
    x-on:error-created.window="$wire.$refresh"
    x-on:error-edited.window="$wire.$refresh"
    x-on:error-deleted.window="$wire.$refresh"
>

    <livewire:errors.create-error :$categories/>
    <livewire:errors.delete-error/>
    <livewire:errors.solutions.delete-all-solutions @all-solutions-deleted.window="$refresh"/>

    <livewire:solutions.delete-solution @solution-deleted.window="$refresh"/>

    <div class="flex flex-col sm:flex-row mt-4 w-full gap-y-2 gap-x-8">
        <x-inputs.search class="sm:w-[80%]" inputAttr="wire:model.live=search"/>
        <select wire:model.live="category" class="select select-bordered grow sm:max-w-xs">
            <option value="" selected>All</option>
            @foreach($categories as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-center h-8 mt-4">
        <span class="loading loading-bars loading-lg" wire:loading/>
    </div>

    <ul class="list-none mt-0 pl-0">
        @forelse($errors as $error)
            <livewire:errors.edit-error wire:key="edit-error-{{$error->getKey()}}" :$categories :$error/>
            <li
                wire:key="{{$error->getKey()}}"
                class="shadow-lg bg-white rounded py-4 mb-6 [&>div]:flex [&>div]:max-w-lg [&>div]:px-8 [&>div]:justify-between [&>div>span]:w-1/2">
                <div class="flex flex-col !py-0 !px-4 md:flex-row md:!justify-between items-center !max-w-full !w-full">
                    <h2 class="w-full md:w-[85%] !p-1 mt-0 break-words">
                        <span>{{$error->name}}</span>
                    </h2>
                    <div class="md:w-[15%] mb-4 sm:mb-0 mt-0 flex justify-end">
                        <div>
                            <span
                                @click="$dispatch('edit-error', {id: '{{$error->id}}'})"
                                class="link link-primary"
                            >
                                 Edit
                            </span>
                            <span class="h-full border border-amber-950 mx-2"></span>
                            <span
                                @click="$dispatch('delete-error', {errorId: '{{$error->id}}'})"
                                class="link link-primary"
                            >
                                Delete
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                    <span>Category</span>
                    <div class="w-1/2">
                        <span class="badge badge-accent !w-auto">{{$error->category->name}}</span>
                    </div>
                </div>
                <div>
                    <span>Project Name</span>
                    <span>{{Str::overwriteEmpty($error->project_name)}}</span>
                </div>
                <div>
                    <span>Project URL</span>
                    <span>
                        <a href="{{$error->project_url}}" target="_blank"
                           class="inline-block w-full link-accent text-ellipsis overflow-hidden whitespace-nowrap hover:cursor-pointer">
                            {{Str::overwriteEmpty($error->project_url)}}
                        </a>
                    </span>
                </div>
                <div>
                    <span>Created at</span>
                    <span
                        class="text-ellipsis overflow-hidden text-nowrap">{{$error->created_at->diffForHumans()}}</span>
                </div>
                <div class="mb-2">
                    <span>Updated at</span>
                    <span
                        class="text-ellipsis overflow-hidden text-nowrap">{{$error->updated_at->diffForHumans()}}</span>
                </div>
                <div x-data="{showDescription: false}" class="w-full mb-4 !max-w-full">
                    <div
                        class="collapse collapse-plus bg-base-200"
                        :class="showDescription ? 'collapse-open' : 'collapse-close'"
                    >
                        <div
                            @click="showDescription = !showDescription"
                            class="collapse-title text-lg font-medium cursor-pointer"
                        >
                            <span x-text="showDescription ? 'Hide description' : 'Show description'"></span>
                        </div>
                        <div class="collapse-content">
                            @if($error->description)
                                <div class="code p-4">{!! $error->description !!}</div>
                            @else
                                <p class="text-warning">No description found for this error</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div x-data="{showStackTrace: false}" class="w-full mb-4 !max-w-full">
                    <div
                        class="collapse collapse-plus bg-base-200"
                        :class="showStackTrace ? 'collapse-open' : 'collapse-close'"
                    >
                        <div
                            @click="showStackTrace = !showStackTrace"
                            class="collapse-title text-lg font-medium cursor-pointer"
                        >
                            <span x-text="showStackTrace ? 'Hide stack trace' : 'Show stack trace'"></span>
                        </div>
                        <div class="collapse-content">
                            @if($error->stack_trace)
                                <div><p class="p-4 code">{!! $error->stack_trace !!}</p></div>
                            @else
                                <p class="text-warning">No stack trace found for this error</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div x-data="{showSolutions: false}" class="w-full !max-w-full">
                    <div
                        class="collapse collapse-plus bg-base-200"
                        :class="showSolutions ? 'collapse-open' : 'collapse-close'"
                    >
                        <div
                            @click="showSolutions = !showSolutions"
                            class="collapse-title text-lg font-medium cursor-pointer"
                        >
                            <span x-text="showSolutions ? 'Hide solutions' : 'Show solutions'"></span>
                        </div>
                        <div class="collapse-content">
                            @if($error->solutions)
                                <ol
                                    x-data="{show:true}"
                                    x-show="show"
                                    @remove-solution-list.window="if($event.detail.errorId === '{{$error->getKey()}}') {show=false}"
                                    class="list-none space-y-4 pl-0"
                                    x-transition
                                >
                                    @foreach($error->solutions as $solution)
                                        <li
                                            x-data="{showEditForm: false}"
                                            @solution-updated.window="showEditForm=false"
                                            wire:key="{{$solution->getKey()}}"
                                            class="bg-white"
                                        >
                                            <div x-show="!showEditForm" x-tansition class="flex flex-col sm:flex-row">
                                                <div
                                                    class="flex flex-col pt-2 sm:pt-0 sm:w-[10%] border-r px-2 justify-center items-center">
                                                    <span class="badge badge-info">{{$solution->rank}}</span>
                                                    <span>Rank</span>
                                                </div>
                                                <div class="sm:w-[90%]">
                                                    <div class="code px-2">{!! $solution->text !!}</div>
                                                </div>
                                            </div>
                                            <div x-show="showEditForm" x-transition class="p-4">
                                                <livewire:errors.solutions.edit-solution
                                                    wire:key="edit-solution-{{$solution->getKey()}}"
                                                    :$error
                                                    :$solution
                                                    @solution-updated="$refresh"
                                                />
                                            </div>
                                            <div
                                                class="flex sm:flex-row flex-col sm:justify-between items-center p-4 text-sm">
                                                <div>
                                                    <span
                                                        @click="showEditForm=!showEditForm"
                                                        x-text="showEditForm ? 'Show' : 'Edit'"
                                                        class="link link-primary px-4 border-r-2 border-amber-950"
                                                    >
                                                    </span>
                                                    <span
                                                        @click="$dispatch('delete-solution', { solutionId: '{{$solution->getKey()}}' })"
                                                        class="link link-primary px-4"
                                                    >
                                                        Delete
                                                    </span>
                                                </div>
                                                <div class="mt-2 sm:mt-0">
                                                    <span>Updated: &nbsp;</span><span>{{$solution->updated_at->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                                <div class="flex">
                                    <div class="w-[10%]"></div>
                                    <div x-data="{showCreateSolution: false}"
                                         @solution-created="showCreateSolution = false" class="flex-grow px-8 py-2">
                                        <div x-show="showCreateSolution" x-trap="showCreateSolution" x-transition
                                             class="mb-2">
                                            <livewire:errors.solutions.create-solution
                                                wire:key="create-solution-{{$error->getKey()}}"
                                                :error="$error"
                                                @solution-created="$refresh"
                                            />
                                        </div>
                                        <div>
                                            <span
                                                @click="showCreateSolution = !showCreateSolution"
                                                x-text="showCreateSolution ? 'Hide' : 'Create'"
                                                class="link link-primary"
                                            >
                                           </span>

                                            @if($error->solutions->isNotEmpty())
                                                <span class="h-full mx-4 border border-amber-950"></span>
                                                <span
                                                    @click="$dispatch('delete-all-solutions', { errorId: '{{$error->getKey()}}' })"
                                                    class="link link-primary"
                                                >
                                                    Delete All
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-warning">No solutions found for this error</p>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <p wire:loading.remove class="text-2xl text-center text-error">No Errors Found !</p>
        @endforelse
    </ul>

    {{$errors->links()}}
</div>
