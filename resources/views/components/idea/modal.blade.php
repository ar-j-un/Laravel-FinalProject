    {{-- <!-- modal -> --}}
        <x-modal name="create-idea" title="New Idea">
            <form 
            x-data="{ 
            status: 'pending',
            newLink: '',
            links: [],
            newStep: '',
            steps: [],
            }" 
            method="POST" 
            action="{{ route('idea.store') }}"
            enctype="multipart/form-data"
            >
                @csrf

                <div class="space-y-6">
                    <x-form.field
                        label="Title"
                        name="title"
                        placeholder="Enter an idea for your title"
                        autofocus
                        required
                    />

                    <div class="space-y-2">
                        <label for="status" class="label">Status</label>

                        <div class="flex gap-x-3">
                            @foreach (App\IdeaStatus::cases() as $status)
                                <button
                                    type="button"
                                    @click="status = @js($status->value)"
                                    data-test="create-status-{{ $status->value }}-button"
                                    class="btn flex-1 h-10"
                                    {{-- :class="status === @js($status->value) ? 'btn-primary' : 'btn-outlined'" --}}
                                    :class="{'btn-outlined': status !== @js($status->value)}"
                                >
                                    {{ $status->label() }}
                                </button>
                            @endforeach

                            <input type="hidden" name="status" :value="status" class="input">
                        </div>
                        <x-form.error name="status" />
                    </div>

                    <x-form.field
                        label="Description"
                        name="description"
                        type="textarea"
                        placeholder="Describe your idea..."
                    />

                    <div class="space-y-2">
                        <label for="image" class="label">Featured Image</label>
                        <input type="file" name="image" accept="image/*">
                        <x-form.error name="image" />
                    </div>

                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Actionable Steps</legend>

                            <template x-for="(step, index) in steps">
                                <div class="flex gap-x-2 items-center">

                                <input name="steps[]" x-model="step" class="input">

                                <button
                                    type="button" 
                                    @click="steps.splice(index, 1)"
                                    aria-label="Remove step button"
                                    class="form-muted-icon"
                                >
                                    <x-icons.close />
                                </button>

                                </div>
                            </template>

                            <div class="flex gap-x-2 items-center">
                                <input
                                    x-model="newStep"
                                    id="new-step"
                                    data-test="new-step"
                                    placeholder="What needs to be done?"
                                    class="input flex-1"
                                    spellcheck="false"
                                >
                                <button
                                    type="button" 
                                    @click="steps.push(newStep.trim()); newStep = ''"
                                    data-test="add-new-step-button"
                                    :disabled="newStep.trim().length === 0"
                                    aria-label="Add New step button"
                                    class="form-muted-icon"

                                >
                                    <x-icons.close class="rotate-45" />
                                </button>
                            </div>

                        </fieldset>
                    </div>


                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>

                            <template x-for="(link, index) in links">
                                <div class="flex gap-x-2 items-center">

                                <input name="links[]" x-model="link" class="input">

                                <button
                                    type="button" 
                                    @click="links.splice(index, 1)"
                                    aria-label="Remove link button"
                                    class="form-muted-icon"
                                >
                                    <x-icons.close />
                                </button>

                                </div>
                            </template>

                            <div class="flex gap-x-2 items-center">
                                <input
                                    x-model="newLink"
                                    type="url"
                                    id="new-link"
                                    data-test="new-link"
                                    placeholder="http://example.com"
                                    autocomplete="url"
                                    class="input flex-1"
                                    spellcheck="false"
                                >
                                <button
                                    type="button" 
                                    @click="links.push(newLink.trim()); newLink = ''"
                                    data-test="add-new-link-button"
                                    :disabled="newLink.trim().length === 0"
                                    aria-label="Add New link button"
                                    class="form-muted-icon"

                                >
                                    <x-icons.close class="rotate-45" />
                                </button>
                            </div>

                        </fieldset>
                    </div>

                    <div class="flex justify-end gap-x-5">
                        <button type="reset" @click="$dispatch('close-modal')">Cancel</button>
                        <button type="submit" class="btn">Create</button>
                    </div>
                </div>
            </form>
        </x-modal>
