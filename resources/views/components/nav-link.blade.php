 @props(['active'=>false, 'mobile'=>false])   
  
 <a {{ $attributes->merge([ 'class' => 
    ( $active ? ' bg-gray-900 text-white ' : 'text-gray-300 hover:bg-gray-700 hover:text-white ') .
    ( $mobile ? ' block text-base ' : '') .
    'rounded-md px-3 py-2 font-medium']) }} > {{ $slot }} </a> 
    

   