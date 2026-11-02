document.getElementById('foodForm').addEventListener('submit', function(event) {
    const vendorName = document.getElementById('vendor_name').value.trim();
    const vendorLocation = document.getElementById('vendor_location').value.trim();
    const foodName = document.getElementById('food_name').value.trim();
    const foodCategory = document.getElementById('food_category').value;
    const foodDescription = document.getElementById('food_description').value.trim();
    const foodPrice = parseFloat(document.getElementById('food_price').value);

    if (
        vendorName === '' ||
        vendorLocation === '' ||
        foodName === '' ||
        foodCategory === '' ||
        foodDescription === ''
    ) {
        event.preventDefault();
        alert('Please complete all required fields.');
        return;
    }

    if (isNaN(foodPrice) || foodPrice <= 0) {
        event.preventDefault();
        alert('Please enter a valid food price greater than RM0.');
        return;
    }

    alert('Food Experience form submitted successfully!');
});
