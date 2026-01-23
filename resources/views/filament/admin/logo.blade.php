<div class="flex gap-4 items-end">
<!--    <x-application-logo class="h-8 bg-red-600"/>-->
    <div
            class="text-2xl font-semibold transition-all duration-200 cursor-pointer dark:text-white hover:text-orange-500">
        {{ app()->environment('local') ? 'carlcassar.test' : 'carlcassar.com' }}
    </div>
</div>
