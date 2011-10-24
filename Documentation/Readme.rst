====================================
Documentacion de uso
====================================

Recaptcha
------------------------------------
Para emplear el recaptcha en formularios y actions es necesario:
Crear un **aspecto** que implemente **RecaptchaAbstractAspect** por ejemplo::

    /**
     * @FLOW3\Aspect
     */
    class RecaptchaAspect extends \F2\Base\Aspect\RecaptchaAbstractAspect {

        /**
         * PointCut para las acciones que requiren validacion recaptcha
         *
         * @FLOW3\Pointcut("method(F2\TuitLawyer\Controller\PreguntaController->createAction())")
         * @return void
         */
        public function recaptchaRequiredActions() {
        }

        public function __construct($apikey) {
            parent::__construct($apikey);
        }
        /**
         * @param \TYPO3\FLOW3\AOP\JoinPointInterface $joinPoint
         * @return void
         * @FLOW3\Before("F2\TuitLawyer\Aspect\RecaptchaAspect->recaptchaRequiredActions")
         */
        public function validate(\TYPO3\FLOW3\AOP\JoinPointInterface $joinPoint) {
            parent::validate($joinPoint);
        }
    }

En el pointcut hay que especificar los Actions para los que queremos validar el catcha.
Hay que implementar los tres metodos especificados en el ejemplo.
Para mostrar el captcha hay que cargar un **ViewHelper** que se encarga de mostrar la imagen con el texto. El ViewHelper se llama **recaptcha** y **no requiere parametros**.
Para emplear Recaptcha hacen falta dos keys que se generan el pagina de recaptcha, estas keys se insertan mediante injeccionde dependencias en **objects.yaml** por ejemplo::

    F2\TuitLawyer\Aspect\RecaptchaAspect:
      arguments:
        1:
          setting: F2.TuitLawyer.Recaptcha.privatekey

    F2\Base\ViewHelpers\RecaptchaViewHelper:
      arguments:
        1:
          setting: F2.TuitLawyer.Recaptcha.publickey

NumberOfWordsValidator
-----------------------------------------------------
Validador para contar el numero de palabras, Solo tiene un parametro, que es el numero de palabras.
Ejemplo de uso::

    /**
	 * El texto 
	 * @FLOW3\Validate(type="\F2\Base\Validation\NumberOfWordsValidator",options={"max"=150})
	 * @ORM\Column(type="text")
	 * @var string
	 */
	protected $texto;

BaseException
--------------------------------
Es la excepcion base de la que **deben heredar todas las demas Excepciones** de las aplicaciones. Esto es importante porque el manejador de excepciones general captura este tipo de excepciones

BaseController
----------------------------------
Es el controlador del que deben heredar todos los demas controladores. Tiene diversos metodos:

mapSettings($settings)
===============================
Se llama en el initalizeAction ::

    protected function initializeAction() {
		parent::initializeAction();
        $this->mapSettings($this->settings);
	}

Su objetivo es asignar los settings que se necesiten a propiedades de clase para no tener que hacer referencia a *$this->settings* dentro del codigo::

    public function mapSettings(array $settings) {
        $this->ABTestEnabled = $settings['ABTest']['enabled'] == 'y' ? TRUE: FALSE;
        $this->alternativeTemplatesPath = $this->settings['ABTest']['AlternativeTemplatesPath'];
        $this->alternativeLayoutsPath = $this->settings['ABTest']['AlternativeLayoutsPath'];
        $this->alternativePartialsPath = $this->settings['ABTest']['AlternativePartialsPath'];

    }

initializeView(\TYPO3\FLOW3\MVC\View\ViewInterface $view)
===============================================================
Se sobreescribe este metodo para poder realizar tests A/B, para hacer esto hay que poner estos parametros sen settings.yaml::

    F2:
      SLists:
        ABTest:
          enabled: n    #repuesta y/n
          AlternativeTemplatesPath: '/var/www/html/bversion/Templates'
          AlternativePartialsPath: '/var/www/html/bversion/Partials'
          AlternativeLayoutsPath: '/var/www/html/bversion/Layouts'

Dentro de los settings se especifican los path de donde sacar los templates alternativos.
La version b de la pagina se activa usando los templates alternativos cuando se pasa el parametro **bversion=1**

processRequest(\TYPO3\FLOW3\MVC\RequestInterface $request, \TYPO3\FLOW3\MVC\ResponseInterface $response)
=========================================================================================================
Este metodo se sobreescribe para capturar las excepciones de tipo BaseException y redirige al action **exceptionHandler** que debe ser implementado por el controlador