<?php
//Héritage de la classe parent qui s'appelle module
class MyModComments extends Module {
	
	/*
	 Back(j.s)
    */
	 
	//Instanciation de l'objet
	public function __construct() {
		// objet courant "this",attribut classe "name"
		$this->name = 'mymodcomments';
		$this->tab = 'front_office_features';
		$this->version = '0.1.0';
		$this->author = 'Rabia Annane';
		$this->displayName = 'Mon module de commentaires produits';
		$this->description = 'Les clients peuvent noter et commenter les produits';
		$this->bootstrap = true;
		// appel de la constructeur de parent qui statique
		parent::__construct();
		
	}
	// la methode de travail pour le getContent.tpl
	public function getContent() {
		$this->processConfiguration();
	//return"Je suis prêt à être configuré, mais il y a encore du travail à faire";
	    $this->assignConfiguration();
	// Affiche le contenu du fichier dans le fichier courant
    return $this->display(__FILE__, 'getContent.tpl');

	}

public function processConfiguration() {
	
	
	if (Tools::isSubmit('submit_mymodcomments_form')) {
		$enable_grades = Tools::getValue('enable_grades');
		$enable_comments = Tools::getValue('enable_comments');
		//updateValue()qui veut dire si les valeur existe ne rien faire si non on les crees
		Configuration::updateValue('MYMOD_GRADES', $enable_grades);
		Configuration::updateValue('MYMOD_COMMENTS', $enable_comments);
		$this->context->smarty->assign('confirmation', 'ok');
	} else {
	}
}

public function assignConfiguration() {
	// instruction select
	$enable_grades = Configuration::get('MYMOD_GRADES');
	$enable_comments = Configuration::get('MYMOD_COMMENTS');
	
	$this->context->smarty->assign('enable_grades', $enable_grades);
	$this->context->smarty->assign('enable_comments', $enable_comments);
}
/*
 Front
 */

public function install() {
	parent::install();
	$this->registerHook('displayProductTabContent');
	return true;
}

public function hookDisplayProductTabContent($params) {
	
	    // Appel de la fonction précédente
    $this->processProductTabContent();
	$this->assignProductTabContent();
    // Affichage de la vue
    return $this->display(__FILE__, 'displayProductTabContent.tpl');
}

public function processProductTabContent() {
	
        // Si le formulaire a été validé
        if (Tools::isSubmit('mymod_pc_submit_comment')) {
		// Récupération des saisies
		$id_product = Tools::getValue('id_product');
		$grade = Tools::getValue('grade');
		$comment = Tools::getValue('comment');
		// Valorisation des paramètres
		$insert = array(
                'id_product' => (int)$id_product,
                'grade' => (int)$grade,
                'comment' => pSQL($comment),
                'date_add' => date('Y-m-d H:i:s')
            );
		// Insertion dans la BD (nom de la table sans le préfixe)
		Db::getInstance()->insert('mymod_comment', $insert);
        }
}
	public function assignProductTabContent() {
		
		// Récupération des notes et des commentaires
		$enable_grades = Configuration::get('MYMOD_GRADES');
		$enable_comments = Configuration::get('MYMOD_COMMENTS');

		// Récupération du code du produit
		$id_product = Tools::getValue('id_product');
		// Exécution du SELECT dans la BD sur la table des commentaires
		$comments = Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . 'mymod_comment WHERE id_product = ' . (int)$id_product);

		// Création de variables Smarty et affectation de valeurs à ces variables pour l'affichage dans la vue
		$this->context->smarty->assign('enable_grades', $enable_grades);
		$this->context->smarty->assign('enable_comments', $enable_comments);
		$this->context->smarty->assign('comments', $comments);
	}





}




	
