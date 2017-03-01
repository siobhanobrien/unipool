@extends('layouts.app') 
@section('content')
		<div class="payment-container">
			<h2 class="header">Pay for something</h2>
			
			<form action="checkout.php" method="post" autocomplete="off">
				<label for="item">
					Product
					<input type="text" name="product">
				</label>
				<label for="amount">
					Price
					<input type="text" name="price">
				</label>

				<input type="submit" value="Pay">
			</form>

			<p>You'll be taken to PayPal to complete your payment.</p>
		</div>
	</body>
</html>
@endsection