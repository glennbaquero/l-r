<toggle>
    <div slot-scope="{ display, toggled, toggleFalse }" tabindex="0" @focusout="toggleFalse" {{ $attributes->merge(['class' => 'relative'])}}>
        <div @click.prevent="toggled">
            {{ $trigger }}
        </div>

        <div v-show="display" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
        style="display: none;">
            <transition enter-active-class="transition ease-out duration-200"
                        enter-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
            >
                <div class="rounded-md ring-1 ring-black ring-opacity-5 p-3 bg-lightgray cursor-pointer">
                {{ $content }}
                </div>
            </transition>
        </div>
    </div>
</toggle>
