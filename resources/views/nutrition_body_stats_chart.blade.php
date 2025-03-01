<!DOCTYPE html>
<html lang="en">

<head>
    <title>Body Stats</title>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
</head>

<body>
    <h1>User Body Stats</h1>
    <div class="p-4">
        <x-chartjs-component :chart="$chart" />
        
    </div>
</body>


</html>

