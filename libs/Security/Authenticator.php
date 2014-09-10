<?php
namespace Security;
use Nette;
use Nette\Security\Identity;
use Nette\Object,
	Nette\Environment;
use Nette\Security\AuthenticationException;

class Authenticator extends Nette\Object implements Nette\Security\IAuthenticator {

	/** @var Nette\Database\Context */
	private $database;

	/**
	 * @param Nette\Database\Context
	 */
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Performas an authentication
	 * @param array
	 * @return Nette\Security\Identity
	 */
	public function authenticate(array $credentials) {
		list($login, $password) = $credentials;
		$row = $this->database->table('user')->where('username', $login)->fetch();
//		$row = array('id' => 1, 'email' => 'student', 'role' => 'student');

		if (!$row) {
			throw new AuthenticationException('Chyba : Nesprávny login.', self::IDENTITY_NOT_FOUND);
		}

		if ($row->password !== sha1($password)) {
				throw new AuthenticationException('Chyba : Nesprávne heslo.', self::INVALID_CREDENTIAL);
		}
                

		// Active Row is read only
//		unset($row->password);
		return new Identity($row->id, $row->role, $row->toArray());
	}

}