<?php
class transactionControllerTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testGetAll()
	{
		$mock = Mockery::mock('TransactionInterface');
		$mock->shouldReceive('getAll')->once()->andReturn('foo');
		App::instance('TransactionInterface', $mock);

		$response = $this->call('GET', 'transactions');
		$this->assertTrue($response->isOk());
		$this->assertTrue(!! $response->getOriginalContent()->transactions);
	}

}