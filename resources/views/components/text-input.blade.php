@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-dark-300 dark:border-dark-700 dark:bg-white-900 dark:text-dark-300 focus:border-dark-500 dark:focus:border-dark-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
