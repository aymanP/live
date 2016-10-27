<?php
# Version 1.0.0
#
# General
$lang['id']                   = 'ID';
$lang['name']                 = 'Nom';
$lang['options']              = 'Options';
$lang['submit']               = 'Enregistrer';
$lang['added_successfuly']    = '%s ajouté avec succès';
$lang['updated_successfuly']  = '%s mis à jour avec succès';
$lang['edit']                 = 'Editer %s';
$lang['add_new']              = 'Ajout %s';
$lang['deleted']              = '%s supprimé';
$lang['problem_deleting']     = 'Erreur de suppression %s';
$lang['is_referenced']        = 'L\'identifiant %s est déjà utilisé';
$lang['close']                = 'Fermer';
$lang['send']                 = 'Envoyer';
$lang['cancel']               = 'Annuler';
$lang['go_back']              = 'Retour';
$lang['error_uploading_file'] = 'Erreur de chargement du fichier';
$lang['load_more']            = 'Charger plus';
$lang['cant_delete_default']  = 'Impossible de supprimer par défaut %s';

# Invoice General
$lang['invoice_status_paid']                = 'Payée';
$lang['invoice_status_unpaid']              = 'Impayée';
$lang['invoice_status_overdue']             = 'Echue';
$lang['invoice_status_not_paid_completely'] = 'Partiellement payée';

$lang['invoice_pdf_heading'] = 'FACTURE';

$lang['invoice_table_item_heading']            = 'Désignation';
$lang['invoice_table_quantity_heading']        = 'Qté.';
$lang['invoice_table_rate_heading']            = 'Prix unitaire';
$lang['invoice_table_tax_heading']             = 'Taxe';
$lang['invoice_table_amount_heading']          = 'Montant HT';
$lang['invoice_subtotal']                      = 'Total HT';
$lang['invoice_adjustment']                    = 'Ajustement';
$lang['invoice_total']                         = 'Total TTC';
$lang['invoice_vat']                           = 'Numéro de TVA';
$lang['invoice_bill_to']                       = 'Destinataire';
$lang['invoice_data_date']                     = 'Date de facture :';
$lang['invoice_data_duedate']                  = 'Date d\'échéance :';
$lang['invoice_received_payments']             = 'Transactions';
$lang['invoice_no_payments_found']             = 'Aucun règlement trouvé pour cette facture';
$lang['invoice_note']                          = 'Note:';
$lang['invoice_payments_table_number_heading'] = 'Règlement #';
$lang['invoice_payments_table_mode_heading']   = 'Mode de règlement';
$lang['invoice_payments_table_date_heading']   = 'Date de facture';
$lang['invoice_payments_table_amount_heading'] = 'Montant';


# Annonces
$lang['announcement']                 = 'Annonce';
$lang['announcement_lowercase']       = 'annonce';
$lang['announcements']                = 'Annonces';
$lang['announcements_lowercase']      = 'annonces';
$lang['new_announcement']             = 'Ajouter une annonce';
$lang['announcement_name']            = 'Titre de l\'annonce';
$lang['announcement_message']         = 'Message';
$lang['announcement_show_to_staff']   = 'Diffuser pour les collaborateurs';
$lang['announcement_show_to_clients'] = 'Diffuser pour les clients';
$lang['announcement_show_my_name']    = 'Afficher mon nom';

# Clients
$lang['clients']                               = 'Clients';
$lang['client']                                = 'Client';
$lang['new_client']                            = 'Ajouter un client';
$lang['client_lowercase']                      = 'client';
$lang['client_delete_tooltip']                 = 'Toutes les données clients seront  supprimées. Contrats, tickets, notes. Remarque : Si la facture est affiliée à un client elle ne pourra pas être supprimée. Vous devez attribuer cette facture à un autre client afin de conserver la chronologie des factures.';
$lang['customer_delete_invoices_warning']      = 'Ce client a des factures existantes. Vous ne pouvez pas supprimer ce client. Vous devez d’abord attribuer les factures à un autre client avant de le supprimer.';
$lang['client_firstname']                      = 'Prénom';
$lang['client_lastname']                       = 'Nom';
$lang['client_email']                          = 'Email';
$lang['client_company']                        = 'Société';
$lang['client_vat_number']                     = 'Numéro de TVA';
$lang['client_address']                        = 'Adresse';
$lang['client_city']                           = 'Ville';
$lang['client_postal_code']                    = 'Code Postal';
$lang['client_state']                          = 'Région';
$lang['client_password']                       = 'Mot de passe';
$lang['client_password_change_populate_note']  = 'Remarque : si vous remplissez ce champ, le mot de passe de ce client sera modifié.';
$lang['client_password_last_changed']          = 'Dernière modification du mot de passe :';
$lang['login_as_client']                       = 'Afficher l\'espace client';
$lang['client_invoices_tab']                   = 'Factures';
$lang['contracts_invoices_tab']                = 'Contrats';
$lang['contracts_tickets_tab']                 = 'Tickets';
$lang['contracts_notes_tab']                   = 'Notes';
$lang['client_invoice_number_table_heading']   = 'Numéro';
$lang['client_invoice_date_table_heading']     = 'Date de facture';
$lang['client_invoice_due_date_table_heading'] = 'Date d\'échéance';
$lang['client_string_table_heading']           = 'Client';
$lang['client_amount_table_heading']           = 'Montant';
$lang['client_status_table_heading']           = 'Statut';
$lang['note_description']                      = 'Description Note';

$lang['client_string_contracts_table_heading']      = 'Client';
$lang['client_start_date_contracts_table_heading']  = 'Date de début';
$lang['client_end_date_contracts_table_heading']    = 'Date de fin';
$lang['client_description_contracts_table_heading'] = 'Description';
$lang['client_do_not_send_welcome_email']           = 'Ne pas envoyer un email de bienvenue';

$lang['clients_notes_table_description_heading'] = 'Description';
$lang['clients_notes_table_addedfrom_heading']   = 'Ajouté par';
$lang['clients_notes_table_dateadded_heading']   = 'Ajouté le';

$lang['clients_list_full_name']   = 'Client';
$lang['clients_list_last_login']  = 'Dernière connexion';

# Contrats
$lang['contracts']                = 'Contrats';
$lang['contract']                 = 'Contrat';
$lang['new_contract']             = 'Nouveau Contrat';
$lang['contract_lowercase']       = 'contrat';
$lang['contract_start_date']      = 'Date de début';
$lang['contract_end_date']        = 'Date de fin';
$lang['contract_subject']         = 'Sujet';
$lang['contract_description']     = 'Description';
$lang['contract_subject_tooltip'] = 'Le sujet est aussi visible au client';
$lang['contract_client_string']   = 'Client';
$lang['contract_attach']          = 'Pièce jointe';

$lang['contract_list_client']     = 'Client';
$lang['contract_list_subject']    = 'Sujet';
$lang['contract_list_start_date'] = 'Date de début';
$lang['contract_list_end_date']   = 'Date de fin';

# Devises
$lang['currencies']           = 'Devises';
$lang['currency']             = 'Devise';
$lang['new_currency']         = 'Ajouter une devise';
$lang['currency_lowercase']   = 'devise';
$lang['base_currency_set']    = 'Ceci est maintenant votre devise de base.';
$lang['make_base_currency']   = 'Etablir comme devise principale';
$lang['base_currency_string'] = 'Devise principale';

$lang['currency_list_name']   = 'Nom';
$lang['currency_list_symbol'] = 'Symbol';


$lang['currency_add_edit_description'] = 'Nom de la devise';
$lang['currency_add_edit_rate']        = 'Symbol';

$lang['currency_edit_heading'] = 'Editer la devise';
$lang['currency_add_heading']  = 'Ajouter une devise';


# Department
$lang['departments']          = 'Départements';
$lang['department']           = 'Département';
$lang['new_department']       = 'Nouveau Département';
$lang['department_lowercase'] = 'département';

$lang['department_name']             = 'Nom du département';
$lang['department_email']            = 'Email du département';
$lang['department_hide_from_client'] = 'Ne pas afficher aux clients ?';
$lang['department_list_name']        = 'Nom';

# Email Templates
$lang['email_templates']                        = 'Modèles d\'emails';
$lang['email_template']                         = 'Modèle d\'email';
$lang['email_template_lowercase']               = 'modèle d\'email';
$lang['email_templates_lowercase']              = 'modèles d\'emails';
$lang['email_template_ticket_fields_heading']   = 'Tickets';
$lang['email_template_invoices_fields_heading'] = 'Factures';
$lang['email_template_clients_fields_heading']  = 'Clients';

$lang['template_name']                                      = 'Nom du modèle';
$lang['template_subject']                                   = 'Objet';
$lang['template_fromname']                                  = 'De';
$lang['template_fromemail']                                 = 'Depuis l\'email';
$lang['send_as_plain_text']                                 = 'Envoyer au format texte brut';
$lang['email_template_disabed']                             = 'Désactiver';
$lang['email_template_email_message']                       = 'Message Email';
$lang['available_merge_fields']                             = 'Champs de fusion disponibles';
# Home
$lang['dashboard_string']                                   = 'Tableau de bord';
$lang['home_latest_todos']                                  = 'Derniers todos';
$lang['home_no_latest_todos']                               = 'Aucun todo trouvé';
$lang['home_latest_finished_todos']                         = 'Derniers todos accomplis';
$lang['home_no_finished_todos_found']                       = 'Aucun todo accompli trouvé';
$lang['home_todo_heading']                                  = 'Liste des todos à accomplir';
$lang['home_tickets_awaiting_reply_by_department']          = 'Tickets en attente de réponse (par catégorie)';
$lang['home_tickets_awaiting_reply_by_status']              = 'Tickets en attente de réponse (par statut)';
$lang['home_this_week_events']                              = 'Événements Hebdomadaires';
$lang['home_upcoming_events_next_week']                     = 'Événements à venir pour la semaine prochaine';
$lang['home_event_added_by']                                = 'Événement ajouté par';
$lang['home_public_event']                                  = 'Événement public';
$lang['home_weekly_payment_records']                        = 'Encaissements hebdomadaire';
$lang['home_weekend_ticket_opening_statistics']             = 'Statistiques hebdomadaires des ouvertures de tickets';
# Newsfeed
$lang['whats_on_your_mind']                                 = 'Exprimez vous ?';
$lang['new_post']                                           = 'Publier';
$lang['newsfeed_upload_tooltip']                            = 'Astuce: glissez et déposez les fichiers à télécharger';
$lang['newsfeed_all_departments']                           = 'Tous les départements';
$lang['newsfeed_pin_post']                                  = 'Epingler';
$lang['newsfeed_unpin_post']                                = 'Détacher';
$lang['newsfeed_delete_post']                               = 'Supprimer';
$lang['newsfeed_published_post']                            = 'Publié le';
$lang['newsfeed_you_like_this']                             = 'Vous aimez ce post';
$lang['newsfeed_like_this']                                 = 'J\'aime';
$lang['newsfeed_one_other']                                 = 'autre';
$lang['newsfeed_you']                                       = 'Vous';
$lang['newsfeed_and']                                       = 'et';
$lang['newsfeed_you_and']                                   = 'Vous et';
$lang['newsfeed_like_this_saying']                          = 'J\'aime';
$lang['newsfeed_unlike_this_saying']                        = 'Je n\'aime plus';
$lang['newsfeed_show_more_comments']                        = 'Afficher plus de commentaires';
$lang['comment_this_post_placeholder']                      = 'Ajouter un commentaire..';
$lang['newsfeed_post_likes_modal_heading']                  = 'Collègues qui aiment ce post';
$lang['newsfeed_comment_likes_modal_heading']               = 'collègues qui aiment ce commentaire';
$lang['newsfeed_newsfeed_post_only_visible_to_departments'] = 'Ce poste est visible seulement pour les départements suivants: %s';
# Invoice Items
$lang['invoice_items']                                      = 'Articles facture';
$lang['invoice_item']                                       = 'Article facture';
$lang['new_invoice_item']                                   = 'Ajouter un article';
$lang['invoice_item_lowercase']                             = 'article facture';

$lang['invoice_items_list_description'] = 'Désignation';
$lang['invoice_items_list_rate']        = 'Prix unitaire';
$lang['invoice_items_list_tax']         = 'Taxe';

$lang['invoice_item_add_edit_description'] = 'Désignation';
$lang['invoice_item_add_edit_rate']        = 'Prix unitaire';
$lang['invoice_item_add_edit_tax']         = 'Taxe';
$lang['invoice_item_add_edit_tax_select']  = 'Séléctionner une taxe';

$lang['invoice_item_edit_heading'] = 'Edition de l\'article';
$lang['invoice_item_add_heading']  = 'Ajouter un article';

# Factures


$lang['invoices']                       = 'Factures';
$lang['invoice']                        = 'Facture';
$lang['invoice_lowercase']              = 'facture';
$lang['create_new_invoice']             = 'Créer une facture';
$lang['view_invoice']                   = 'Voir la facture';
$lang['invoice_payment_recorded']       = 'Règlement de facture enregistré';
$lang['invoice_payment_record_failed']  = 'Échec de l\'enregistrement du règlement de la facture';
$lang['invoice_sent_to_client_success'] = 'La facture a été envoyée avec succès au client';
$lang['invoice_sent_to_client_fail']    = 'Problème lors de l\'envoi de la facture';
$lang['invoice_reminder_send_problem']  = 'Problème lors de l\'envoi de la facture de rappel';
$lang['invoice_overdue_reminder_sent']  = 'Facture de rappel envoyée avec succès';

$lang['invoice_details']              = 'Détails de la facture';
$lang['invoice_view']                 = 'Voir la facture';
$lang['invoice_select_customer']      = 'Client';
$lang['invoice_add_edit_number']      = 'Numéro de facture';
$lang['invoice_add_edit_date']        = 'Date de facture';
$lang['invoice_add_edit_duedate']     = 'Date d\'échéance';
$lang['invoice_add_edit_currency']    = 'Devise';
$lang['invoice_add_edit_client_note'] = 'Note Client';
$lang['invoice_add_edit_admin_note']  = 'Note Admin';

$lang['invoice_add_edit_search_item']  = 'Rechercher des produits';
$lang['invoices_toggle_table_tooltip'] = 'Afficher le tableau complet';





$lang['edit_invoice_tooltip']                   = 'Editer la facture';
$lang['delete_invoice_tooltip']                 = 'Facture supprimée. Remarque: Tous les règlements concernant cette facture seront supprimés (le cas échéant).';
$lang['invoice_sent_to_email_tooltip']          = 'Envoyer par email';
$lang['invoice_already_send_to_client_tooltip'] = 'Cette facture a déjà été envoyée au client %s';
$lang['send_overdue_notice_tooltip']            = 'Envoyer un avis de retard';
$lang['invoice_view_activity_tooltip']          = 'Historique de la facture';
$lang['invoice_record_payment']                 = 'Enregistrer un règlement';


$lang['invoice_send_to_client_modal_heading']    = 'Envoyer la facture au client';
$lang['invoice_send_to_client_attach_pdf']       = 'Joindre la version PDF';
$lang['invoice_send_to_client_preview_template'] = 'Aperçu du modèle d\'email';

$lang['invoice_dt_table_heading_number']  = 'Numéro';
$lang['invoice_dt_table_heading_date']    = 'Date de facture';
$lang['invoice_dt_table_heading_client']  = 'Client';
$lang['invoice_dt_table_heading_duedate'] = 'Date d\'échéance';
$lang['invoice_dt_table_heading_amount']  = 'Montant';
$lang['invoice_dt_table_heading_status']  = 'Statut';

$lang['record_payment_for_invoice']              = 'Enregistrer un règlement pour';
$lang['record_payment_amount_received']          = 'Montant reçu';
$lang['record_payment_date']                     = 'Date de règlement';
$lang['record_payment_leave_note']               = 'Ajouter une note';
$lang['invoice_payments_received']               = 'Règlements reçus';
$lang['invoice_record_payment_note_placeholder'] = 'Note Admin';
$lang['no_payments_found']                       = 'Aucun règlement trouvé pour cette facture';
$lang['invoice_email_link_text']                 = 'Voir la facture';

# Payments
$lang['payments']                             = 'Règlements';
$lang['payment']                              = 'Règlement';
$lang['payment_lowercase']                    = 'règlement';
$lang['payments_table_number_heading']        = 'Règlement N°';
$lang['payments_table_invoicenumber_heading'] = 'Facture';
$lang['payments_table_mode_heading']          = 'Mode de règlement';
$lang['payments_table_date_heading']          = 'Date';
$lang['payments_table_amount_heading']        = 'Montant';
$lang['payments_table_client_heading']        = 'Client';
$lang['payment_not_exists']                   = 'Le règlement n\'existe pas';

$lang['payment_edit_for_invoice']     = 'Règlement pour la facture N°';
$lang['payment_edit_amount_received'] = 'Montant reçu';
$lang['payment_edit_date']            = 'Date du règlement';
$lang['payment_edit_lave_note']       = 'Ajouter une note';


# Aide en ligne
$lang['kb_article_add_edit_subject'] = 'Sujet';
$lang['kb_article_add_edit_group']   = 'Rubrique';
$lang['kb_string']                   = 'Aide en ligne';
$lang['kb_article']                  = 'Article';
$lang['kb_article_lowercase']        = 'article';
$lang['kb_article_new_article']      = 'Ajouter un article';
$lang['kb_article_disabled']         = 'Désactiver';
$lang['kb_article_description']      = 'Article description';

$lang['kb_table']                      = 'Liste';
$lang['kb_no_articles_found']          = 'Aucun article trouvé';
$lang['kb_dt_article_name']            = 'Article';
$lang['kb_dt_group_name']              = 'Rubrique';
$lang['new_group']                     = 'Créer une rubrique';
$lang['kb_group_add_edit_name']        = 'Nom de la rubrique';
$lang['kb_group_add_edit_description'] = 'Description courte';
$lang['kb_group_add_edit_disabled']    = 'Désactiver';
$lang['kb_group_add_edit_note']        = 'Remarque : Tous les articles de cette rubrique ne seront pas affichés si la fonction "désactiver" est sélectionnée';
$lang['group_table_name_heading']      = 'Nom';
$lang['group_table_isactive_heading']  = 'Active';
$lang['kb_no_groups_found']            = 'Aucune rubrique trouvée';

# Mail Lists
$lang['mail_lists']                           = 'Listes emails';
$lang['mail_list']                            = 'Liste emails';
$lang['new_mail_list']                        = 'Nouvelle liste emails';
$lang['mail_list_lowercase']                  = 'liste emails';
$lang['custom_field_deleted_success']         = 'Champ personnalisé supprimé';
$lang['custom_field_deleted_fail']            = 'Problème lors de la suppression du champ personnalisé';
$lang['email_removed_from_list']              = 'E-mail supprimé de la liste';
$lang['email_remove_fail']                    = 'E-mail supprimé de la liste';
$lang['staff_mail_lists']                     = 'Liste email collaborateurs';
$lang['clients_mail_lists']                   = 'Liste email clients';
$lang['mail_list_total_imported']             = 'Total emails importés: %s';
$lang['mail_list_total_duplicate']            = 'Total emails dupliqués: %s';
$lang['mail_list_total_failed_to_insert']     = 'Echec d\'insertion des emails: %s';
$lang['mail_list_total_invalid']              = 'Adresse email invalide: %s';
$lang['cant_edit_mail_list']                  = 'Vous ne pouvez pas éditer cette liste, celle-ci est renseignée automatiquement';
$lang['mail_list_add_edit_name']              = 'Nom de la liste emails';
$lang['mail_list_add_edit_customfield']       = 'Ajouter un champ personnalisé';
$lang['mail_lists_viewing_emails']            = 'Affichage des emails de la liste';
$lang['mail_lists_view_email_email_heading']  = 'Email';
$lang['mail_lists_view_email_date_heading']   = 'Ajouté le';
$lang['add_new_email_to']                     = 'Ajouter un nouvel email à %s';
$lang['import_emails_to']                     = 'Importer des emails à %s';
$lang['mail_list_new_email_edit_add_label']   = 'Email';
$lang['mail_list_import_file']                = 'Importer un fichier';
$lang['mail_list_available_custom_fields']    = 'Champs personnalisés disponibles';
$lang['submit_import_emails']                 = 'Importer des emails';
$lang['btn_import_emails']                    = 'Importer des emails (Excel)';
$lang['btn_add_email_to_list']                = 'Ajouter l\'email à la liste';
$lang['mail_lists_dt_list_name']              = 'Nom de la liste';
$lang['mail_lists_dt_datecreated']            = 'Date de création';
$lang['mail_lists_dt_creator']                = 'Auteur';
$lang['email_added_to_mail_list_successfuly'] = 'E-mail ajouté à la liste';
$lang['email_is_duplicate_mail_list']         = 'E-mail dèjà présent dans la liste';

# Media
$lang['media_files']            = 'Pièces jointes';

# Payment modes
$lang['new_payment_mode']       = 'Ajouter un mode de règlement';
$lang['payment_modes']          = 'Modes de règlement';
$lang['payment_mode']           = 'Mode de règlement';
$lang['payment_mode_lowercase'] = 'mode de règlement';
$lang['payment_modes_dt_name']  = 'Nom du mode de règlement';

$lang['payment_mode_add_edit_name'] = 'Nom du mode de règlement';
$lang['payment_mode_edit_heading']  = 'Editer le mode de règlement';
$lang['payment_mode_add_heading']   = 'Ajouter un nouveau mode de règlement';

# Predefined Ticket Replies
$lang['new_predefined_reply']              = 'Nouvelle réponse prédéfinie';
$lang['predefined_replies']                = 'Réponses prédéfinies';
$lang['predefined_reply']                  = 'Réponse prédéfinie';
$lang['predefined_reply_lowercase']        = 'réponse prédéfinie';
$lang['predifined_replies_dt_name']        = 'Nom de la réponse prédéfinie';
$lang['predifined_reply_add_edit_name']    = 'Nom de la réponse prédéfinie';
$lang['predifined_reply_add_edit_content'] = 'Contenu de la réponse';

# Ticket Priorities
$lang['new_ticket_priority']           = 'Nouvelle priorité';
$lang['ticket_priorities']             = 'Priorités des tickets';
$lang['ticket_priority']               = 'Priorité du ticket';
$lang['ticket_priority_lowercase']     = 'Priorité du ticket';
$lang['no_ticket_priorities_found']    = 'Aucune priorité de ticket trouvée';
$lang['ticket_priority_dt_name']       = 'Nom de la priorité du ticket';
$lang['ticket_priority_add_edit_name'] = 'Nom de la priorité';

# Reports
$lang['kb_reports']                         = 'Rapports des articles de l\'aide en ligne';
$lang['sales_reports']                      = 'Rapports de ventes';
$lang['reports_choose_kb_group']            = 'Choisir une rubrique';
$lang['reports_sales_select_report_type']   = 'Sélectionner un type de rapport';
$lang['report_kb_yes']                      = 'Oui';
$lang['report_kb_no']                       = 'Non';
$lang['report_kb_no_votes']                 = 'Aucun vote pour l\'instant';
$lang['report_this_week_leads_conversions'] = 'Prospects convertis de la semaine';
$lang['report_leads_sources_conversions']   = 'Sources';
$lang['report_leads_monthly_conversions']   = 'Mensuel';
$lang['sales_report_heading']               = 'Rapport de Ventes';
$lang['report_sales_type_income']           = 'Revenu total';

$lang['report_sales_type_customer']                    = 'Rapport Client';
$lang['report_sales_base_currency_select_explanation'] = 'Vous devez sélectionner une devise car vous avez des factures avec des devises différentes.';
$lang['report_sales_from_date']                        = 'Depuis';
$lang['report_sales_to_date']                          = 'Jusqu\'à';


$lang['report_sales_months_all_time']      = 'Depuis le début';
$lang['report_sales_months_six_months']    = '6 derniers mois';
$lang['report_sales_months_twelve_months'] = '12 derniers mois';
$lang['report_sales_months_custom']        = 'Période personnalisée';
$lang['reports_sales_generated_report']    = 'Rapport généré';



$lang['reports_sales_dt_customers_client']                = 'Client';
$lang['reports_sales_dt_customers_total_invoices']        = 'Total Factures';
$lang['reports_sales_dt_items_customers_amount']          = 'Montant HT';
$lang['reports_sales_dt_items_customers_amount_with_tax'] = 'Montant TTC';

# Roles
$lang['new_role']           = 'Ajouter un rôle';
$lang['all_roles']          = 'Tous les rôles';
$lang['roles']              = 'Rôles collaborateurs';
$lang['role']               = 'Rôle';
$lang['role_lowercase']     = 'rôle';
$lang['roles_total_users']  = 'Total utilisateurs : ';
$lang['roles_dt_name']      = 'Rôle';
$lang['role_add_edit_name'] = 'Rôle';

# Service
$lang['new_service']           = 'Nouveau service';
$lang['services']              = 'Services';
$lang['service']               = 'Service';
$lang['service_lowercase']     = 'service';
$lang['services_dt_name']      = 'Nom du service';
$lang['service_add_edit_name'] = 'Nom du service';

# Settings
$lang['settings']                     = 'Paramètres';
$lang['settings_updated']             = 'Paramètres mis à jour';
$lang['settings_save']                = 'Enregistrer les réglages';
$lang['settings_group_general']       = 'Général';
$lang['settings_group_localization']  = 'Localisation';
$lang['settings_group_tickets']       = 'Tickets';
$lang['settings_group_sales']         = 'Facturation';
$lang['settings_group_email']         = 'Email';
$lang['settings_group_clients']       = 'Clients';
$lang['settings_group_newsfeed']      = 'Fil d\'actualité';
$lang['settings_group_cronjob']       = 'Cron Job';

$lang['settings_yes']                                        = 'Oui';
$lang['settings_no']                                         = 'Non';
$lang['settings_clients_default_theme']                      = 'Thème client par défaut';
$lang['settings_clients_allow_registration']                 = 'Autoriser les clients à s\'enregistrer';
$lang['settings_clients_allow_kb_view_without_registration'] = 'Autoriser l\'affichage de l\'aide en ligne hors inscription au CRM.';

$lang['settings_cron_send_overdue_reminder']                 = 'Envoyer un rappel pour les factures échues';
$lang['settings_cron_send_overdue_reminder_tooltip']         = 'Envoyer un email de relance automatique au client lorsque que le délai de règlement de la facture est échu.';
$lang['automatically_send_invoice_overdue_reminder_after']   = 'Envoyer automatiquement une relance après (jours)';
$lang['automatically_resend_invoice_overdue_reminder_after'] = 'Réenvoyer automatiquement une relance après (jours)';

$lang['settings_email_host']      = 'Serveur SMTP';
$lang['settings_email_port']      = 'Port SMTP';
$lang['settings_email']           = 'Email SMTP';
$lang['settings_email_password']  = 'Mot de passe SMTP';
$lang['settings_email_charset']   = 'Type d\'encodage';
$lang['settings_email_signature'] = 'Signature Email';

$lang['settings_general_company_logo']                = '     ';
$lang['settings_general_company_logo_tooltip']        = 'Dimensions recommandées : 150 x 34px';
$lang['settings_general_company_remove_logo_tooltip'] = 'Retirer le logo';
$lang['settings_general_company_name']                = 'Nom de la société';
$lang['settings_general_company_main_domain']         = 'Site internet';
$lang['settings_general_use_knowledgebase']           = 'Afficher la rubrique Aide en Ligne';
$lang['settings_general_use_knowledgebase_tooltip']   = 'En sélectionnant OUI, la rubrique Aide en Ligne sera également visible sur l\'espace client.';
$lang['settings_general_tables_limit']                = 'Nombre de lignes affichées par défaut dans vos tableaux';
$lang['settings_general_default_staff_role']          = 'Rôle collaborateur par défaut';
$lang['settings_general_default_staff_role_tooltip']  = 'Lorsque vous ajoutez un nouveau collaborateur cette fonction sera sélectionnée par défaut';

$lang['settings_localization_date_format']      = 'Format de date';
$lang['settings_localization_default_timezone'] = 'Fuseau horaire';
$lang['settings_localization_default_language'] = 'Langue par défaut';

$lang['settings_newsfeed_max_file_upload_post']    = 'Nombre maximum de fichiers à télécharger par article';
$lang['settings_newsfeed_max_file_size']           = 'Taille maximale des fichiers (MB)';

$lang['settings_reminders_contracts']         = 'Rappel d\'expiration de contrat';
$lang['settings_reminders_contracts_tooltip'] = 'Notification de rappel d\'expiration en jours';

$lang['settings_tickets_use_services']             = 'Utiliser ce service';
$lang['settings_tickets_max_attachments']          = 'Nombre maximum de pièces jointes par ticket';
$lang['settings_tickets_allow_departments_access'] = 'Autoriser au collaborateur uniquement l\'accès aux tickets correspondants à son département';
$lang['settings_tickets_allowed_file_extensions']  = 'Types de fichiers autorisés pour les pièces jointes';

$lang['settings_sales_general']                                    = 'Général';
$lang['settings_sales_general_note']                               = 'Préférences générales';
$lang['settings_sales_invoice_prefix']                             = 'Préfixe numéro de facture';
$lang['settings_sales_decimal_separator']                          = 'Séparateur décimal';
$lang['settings_sales_thousand_separator']                         = 'Séparateur des milliers';
$lang['settings_sales_currency_placement']                         = 'Position de la devise';
$lang['settings_sales_currency_placement_before']                  = 'Avant le montant';
$lang['settings_sales_currency_placement_after']                   = 'Après le montant';
$lang['settings_sales_require_client_logged_in_to_view_invoice']   = 'Exiger que le client soit connecté pour voir la facture';
$lang['settings_sales_next_invoice_number']                        = 'Prochain numéro de facture';
$lang['settings_sales_next_invoice_number_tooltip']                = 'Réglez ce champ sur 1 si vous voulez commencer à partir du début';
$lang['settings_sales_decrement_invoice_number_on_delete']         = 'Incrémenter le numéro de facture lors de la suppression';
$lang['settings_sales_decrement_invoice_number_on_delete_tooltip'] = 'Voulez-vous décrémenter le numéro de facture lorsque la dernière facture est supprimée ?  Ex. Si vous sélectionnez cette option sur OUI, la facture numéro 15 supprimée, le prochain numéro de facture sera le 14. Si vous sélectionnez  cette option sur NON la prochaine facture gardera le numéro 15.';
$lang['settings_sales_invoice_number_format']                      = 'Format de numérotation de facture';
$lang['settings_sales_invoice_number_format_year_based']           = 'Année et base de numéro';
$lang['settings_sales_invoice_number_format_number_based']         = 'Base de numéro (000001)';
$lang['settings_sales_invoice_year']                               = 'Année de facturation (AAAA/000001)';
$lang['settings_sales_invoice_year_tooltip']                       = 'Affiche l\'année courante. Le numéro séquentiel sera réinitialisé chaque année.';

$lang['settings_sales_company_info_heading'] = 'Informations société';
$lang['settings_sales_company_info_note']    = 'Ces informations seront affichées sur les factures/devis/règlements et autres documents PDF où les infos de l\'entreprise sont nécessaires.';
$lang['settings_sales_company_name']         = 'Nom de la société';
$lang['settings_sales_address']              = 'Adresse';
$lang['settings_sales_city']                 = 'Ville';
$lang['settings_sales_country_code']         = 'Code Pays';
$lang['settings_sales_postal_code']          = 'Code Postal';
$lang['settings_sales_phonenumber']          = 'Téléphone';

# Prospects
$lang['new_lead']       = 'Ajouter un prospect';
$lang['leads']          = 'Prospects';
$lang['lead']           = 'Prospect';
$lang['lead_lowercase'] = 'prospect';
$lang['leads_all']      = 'Tous';

$lang['leads_canban_notes']  = 'Notes: %s';
$lang['leads_canban_source'] = 'Source: %s';

$lang['lead_new_source']            = 'Ajouter une source';
$lang['lead_sources']               = 'Sources des prospects';
$lang['lead_source']                = 'Source du prospect';
$lang['lead_source_lowercase']      = 'source du prospect';
$lang['leads_sources_not_found']    = 'Aucune source de prospects trouvée';
$lang['leads_sources_table_name']   = 'Nom de la source';
$lang['leads_source_add_edit_name'] = 'Nom de la source';

$lang['lead_new_status']         = 'Ajouter un statut de prospect';
$lang['lead_statuss']            = 'Statut du prospect';
$lang['lead_status']             = 'Statut du prospect';
$lang['lead_status_lowercase']   = 'statut du prospect';
$lang['leads_status_table_name'] = 'Nom du statut';

$lang['leads_status_add_edit_name']  = 'Nom du statut';
$lang['leads_status_add_edit_order'] = 'Ordre';

$lang['lead_statuses_not_found']      = 'Aucun statut de prospect trouvé';
$lang['leads_search']                 = 'Rechercher un prospect';

$lang['leads_table_total'] = 'Total Prospects : %s';

$lang['leads_dt_name']         = 'Nom';
$lang['leads_dt_email']        = 'Email';
$lang['leads_dt_phonenumber']  = 'Téléphone';
$lang['leads_dt_assigned']     = 'Attribuer à';
$lang['leads_dt_status']       = 'Statut';
$lang['leads_dt_last_contact'] = 'Dernier contact';

$lang['lead_add_edit_name']                 = 'Nom';
$lang['lead_add_edit_email']                = 'Email';
$lang['lead_add_edit_phonenumber']          = 'Téléphone';
$lang['lead_add_edit_source']               = 'Source';
$lang['lead_add_edit_status']               = 'Statut du prospect';
$lang['lead_add_edit_assigned']             = 'Attribuer à';
$lang['lead_add_edit_datecontacted']        = 'Date de contact';
$lang['lead_add_edit_contected_today']      = 'Contacté aujourd\'hui';
$lang['lead_add_edit_activity']             = 'Historique';
$lang['lead_add_edit_notes']                = 'Notes';
$lang['lead_add_edit_add_note']             = 'Ajouter une note';
$lang['lead_not_contacted']                 = 'Je n\'ai pas contacté ce prospect';
$lang['lead_add_edit_contected_this_lead']  = 'Je suis entré en contact avec ce prospect';
$lang['lead_confirmation_canban_contacted'] = 'Avez-vous pris contact avec ce prospect ?';

# Misc
$lang['activity_log_when_cron_job'] = 'Cron Job';
$lang['access_denied']              = 'Accès refusé';
$lang['prev']                       = 'Précédent';
$lang['next']                       = 'Suivant';

# Datatables
$lang['dt_paginate_first']          = 'Première';
$lang['dt_paginate_last']           = 'Dernière';
$lang['dt_paginate_next']           = 'Suivante';
$lang['dt_paginate_previous']       = 'Précédente';
$lang['dt_empty_table']             = 'Aucun {0} trouvé';
$lang['dt_search']                  = 'Rechercher :';
$lang['dt_zero_records']            = 'Aucun enregistrement correspondant trouvé';
$lang['dt_loading_records']         = 'Chargement...';
$lang['dt_length_menu']             = 'Voir _MENU_ ';
$lang['dt_info_filtered']           = '(Filtré à parir de _MAX_ total {0})';
$lang['dt_info_empty']              = 'Affichage de 0 à 0 sur 0 {0}';
$lang['dt_info']                    = 'Affichage de _START_ à _END_ sur _TOTAL_ {0}';
$lang['dt_empty_table']             = 'Aucun {0} trouvé';
$lang['dt_sort_ascending']          = 'activer pour trier la colonne ascendante';
$lang['dt_sort_descending']         = 'activer pour trier la colonne descendante';
# Invoice Activity Log
$lang['user_sent_overdue_reminder'] = '%s rappel de la facture échue envoyé';

# Weekdays
$lang['wd_monday']    = 'Lundi';
$lang['wd_tuesday']   = 'Mardi';
$lang['wd_wednesday'] = 'Mercredi';
$lang['wd_thursday']  = 'Jeudi';
$lang['wd_friday']    = 'Vendredi';
$lang['wd_saturday']  = 'Samedi';
$lang['wd_sunday']    = 'Dimanche';

# Admin Left Sidebar
$lang['als_dashboard'] = 'Tableau de bord';
$lang['als_clients']   = 'Clients';
$lang['als_leads']     = 'Prospects';

$lang['als_contracts'] = 'Contrats';

$lang['als_all_tickets'] = 'Tous les tickets';
$lang['als_sales']       = 'Ventes';

$lang['als_staff'] = 'Collaborateurs';
$lang['als_tasks'] = 'Tâches';
$lang['als_kb']    = 'Aide en ligne';

$lang['als_surveys']               = 'Sondages';
$lang['als_media']                 = 'Média';
$lang['als_reports']               = 'Rapports';
$lang['als_reports_sales_submenu'] = 'Ventes';
$lang['als_reports_leads_submenu'] = 'Prospects';
$lang['als_kb_articles_submenu']   = 'Articles (Aide en ligne)';
$lang['als_utilities']             = 'Utilitaires';
$lang['als_announcements_submenu'] = 'Annonces';
$lang['als_mail_lists_submenu']    = 'Listes emails';
$lang['als_calendar_submenu']      = 'Calendrier';
$lang['als_activity_log_submenu']  = 'Journal d\'activité';

# Admin Customizer Sidebar
$lang['acs_tickets']                           = 'Tickets';
$lang['acs_ticket_priority_submenu']           = 'Priorité ticket ';
$lang['acs_ticket_statuses_submenu']           = 'Statut ticket';
$lang['acs_ticket_predefined_replies_submenu'] = 'Réponses prédéfinies';
$lang['acs_ticket_services_submenu']           = 'Services';
$lang['acs_departments']                       = 'Départements';
$lang['acs_leads']                             = 'Prospects';
$lang['acs_leads_sources_submenu']             = 'Sources';
$lang['acs_leads_statuses_submenu']            = 'Statuts';
$lang['acs_sales_taxes_submenu']               = 'Taxes';
$lang['acs_sales_currencies_submenu']          = 'Devises';
$lang['acs_sales_payment_modes_submenu']       = 'Modes de règlement';
$lang['acs_email_templates']                   = 'Modèles d\'emails';
$lang['acs_roles']                             = 'Rôles';
$lang['acs_settings']                          = 'Configuration';

# Tickets
$lang['new_ticket']                                         = 'Ouvrir un nouveau ticket';
$lang['tickets']                                            = 'Tickets';
$lang['ticket']                                             = 'Ticket';
$lang['ticket_lowercase']                                   = 'ticket';
$lang['support_tickets']                                    = 'Support Tickets';
$lang['support_ticket']                                     = 'Support Ticket';
$lang['ticket_settings_to']                                 = 'Pour';
$lang['ticket_settings_email']                              = 'Email';
$lang['ticket_settings_departments']                        = 'Département';
$lang['ticket_settings_service']                            = 'Service';
$lang['ticket_settings_priority']                           = 'Priorité';
$lang['ticket_settings_subject']                            = 'Sujet';
$lang['ticket_settings_assign_to']                          = 'Attribuer un ticket (utilisateur en cours par défaut)';
$lang['ticket_settings_assign_to_you']                      = 'Vous';
$lang['ticket_settings_select_client']                      = 'Sélectionner un client';
$lang['ticket_add_body']                                    = 'Contenu du ticket';
$lang['ticket_add_attachments']                             = 'Pièces jointes';
$lang['ticket_no_reply_yet']                                = 'Pas de réponse pour l\'instant';
$lang['new_ticket_added_succesfuly']                        = 'Ticket #%s ajouté avec succès';
$lang['replied_to_ticket_succesfuly']                       = 'ticket #%s répondu avec succès';
$lang['ticket_settings_updated_successfuly']                = 'Paramètres du ticket mis à jour avec succès';
$lang['ticket_settings_updated_successfuly_and_reassigned'] = 'Paramètres du ticket mis à jour avec succès - attribués au département % s ';
$lang['ticket_dt_subject']                                  = 'Sujet';
$lang['ticket_dt_department']                               = 'Département';
$lang['ticket_dt_service']                                  = 'Service';
$lang['ticket_dt_submitter']                                = 'Client';
$lang['ticket_dt_status']                                   = 'Statut';
$lang['ticket_dt_priority']                                 = 'Priorité';
$lang['ticket_dt_last_reply']                               = 'Dernière réponse';

$lang['ticket_single_add_reply']                  = 'Ajouter une réponse';
$lang['ticket_single_add_note']                   = 'Ajouter une note';
$lang['ticket_single_other_user_tickets']         = 'Autres tickets';
$lang['ticket_single_settings']                   = 'Réglages';
$lang['ticket_single_priority']                   = 'Priorité: %s';
$lang['ticket_single_last_reply']                 = 'Dernière réponse : %s';
$lang['ticket_single_change_status_top']          = 'Changer le statut';
$lang['ticket_single_ticket_note_by']             = 'Note du ticket par %s';
$lang['ticket_single_note_added']                 = 'Note ajoutée : %s';
$lang['ticket_single_change_status']              = 'Changer le statut';
$lang['ticket_single_assign_to_me_on_update']     = 'M\'assigner ce ticket automatiquement';
$lang['ticket_single_insert_predefined_reply']    = 'Insérer une réponse prédéfinie';
$lang['ticket_single_insert_knowledge_base_link'] = 'Insérer le lien de l\'aide en ligne';
$lang['ticket_single_attachments']                = 'Pièces jointes';
$lang['ticket_single_add_response']               = 'Ajouter une réponse';
$lang['ticket_single_note_heading']               = 'Note';
$lang['ticket_single_add_note']                   = 'Ajouter une note';
$lang['ticket_settings_none_assigned']            = 'Aucun';
$lang['ticket_status_changed_successfuly']        = 'Le statut du ticket a été changé';
$lang['ticket_status_changed_fail']               = 'Problème lors du changement de statut du ticket';

$lang['ticket_staff_string']                    = 'Collaborateur';
$lang['ticket_client_string']                   = 'Client';
$lang['ticket_posted']                          = 'Publié: %s';
$lang['ticket_insert_predefined_reply_heading'] = 'Insérer une réponse prédéfinie';
$lang['ticket_kb_link_heading']                 = 'Insérer le lien de l\'aide en ligne';
$lang['ticket_access_by_department_denied']     = 'Vous n\'avez pas accès à ce ticket. Celui-ci appartient au département auquel vous n\'êtes pas affecté.';

# Staff
$lang['new_staff']                       = 'Ajouter un collaborateur';
$lang['staff_members']                   = 'Collaborateurs';
$lang['staff_member']                    = 'Collaborateur';
$lang['staff_member_lowercase']          = 'collaborateur';
$lang['staff_profile_updated']           = 'Votre profil a été mis à jour';
$lang['staff_old_password_incorect']     = 'Votre ancien mot de passe est incorrect';
$lang['staff_password_changed']          = 'Votre mot de passe a été changé';
$lang['staff_problem_changing_password'] = 'Problème pour modifier votre mot de passe';
$lang['staff_profile_string']            = 'Profil';

$lang['staff_cant_remove_main_admin']          = 'Impossible de supprimer l\'administrateur principal';
$lang['staff_cant_remove_yourself_from_admin'] = 'Vous ne pouvez pas vous retirer du rôle d\'administrateur';

$lang['staff_dt_name']       = 'Prénom / Nom';
$lang['staff_dt_email']      = 'Email';
$lang['staff_dt_last_Login'] = 'Dernière connexion';
$lang['staff_dt_active']     = 'Actif';

$lang['staff_add_edit_firstname']             = 'Prénom';
$lang['staff_add_edit_lastname']              = 'Nom';
$lang['staff_add_edit_email']                 = 'Email';
$lang['staff_add_edit_phonenumber']           = 'Téléphone';
$lang['staff_add_edit_facebook']              = 'Facebook';
$lang['staff_add_edit_linkedin']              = 'LinkedIn';
$lang['staff_add_edit_skype']                 = 'Skype';
$lang['staff_add_edit_departments']           = 'Member departments';
$lang['staff_add_edit_role']                  = 'Rôle';
$lang['staff_add_edit_permissions']           = 'Permissions des modules :';
$lang['staff_add_edit_administrator']         = 'Définir comme administrateur';
$lang['staff_add_edit_password']              = 'Mot de passe';
$lang['staff_add_edit_password_note']         = 'Remarque: si vous remplissez les champs, le mot de passe de ce collaborateur sera modifié.';
$lang['staff_add_edit_password_last_changed'] = 'Dernière modification du mot de passe';
$lang['staff_add_edit_notes']                 = 'Notes';
$lang['staff_add_edit_note_description']      = 'Note description';

$lang['staff_notes_table_description_heading'] = 'Note';
$lang['staff_notes_table_addedfrom_heading']   = 'Ajouté par';
$lang['staff_notes_table_dateadded_heading']   = 'Ajouté le';

$lang['staff_admin_profile']         = 'Ceci est le profil administrateur';
$lang['staff_profile_notifications'] = 'Notifications';
$lang['staff_profile_departments']   = 'Départements';

$lang['staff_edit_profile_image']                     = 'Image Profil';
$lang['staff_edit_profile_your_departments']          = 'Votre département';
$lang['staff_edit_profile_change_your_password']      = 'Modifier votre mot de passe';
$lang['staff_edit_profile_change_old_password']       = 'Ancien mot de passe';
$lang['staff_edit_profile_change_new_password']       = 'Nouveau mot de passe';
$lang['staff_edit_profile_change_repet_new_password'] = 'Répeter le mot de passe';

# Sondages
$lang['new_survey']                    = 'Nouveau sondage';
$lang['surveys']                       = 'Sondages';
$lang['survey']                        = 'Sondage';
$lang['survey_lowercase']              = 'sondage';
$lang['survey_no_mail_lists_selected'] = 'Aucune liste emails sélectionnée';
$lang['survey_send_success_note']      = 'Tous les emails du sondage (%s) seront envoyés par l\'emploi du CRON Job avec un intervalle de 5 minutes';
$lang['survey_result']                 = 'Résultat pour le sondage : %s';
$lang['question_string']               = 'Question';
$lang['question_field_string']         = 'Champ';

$lang['survey_list_view_tooltip']         = 'Voir le sondage';
$lang['survey_list_view_results_tooltip'] = 'Voir les résultats';

$lang['survey_add_edit_subject']                   = 'Sujet';
$lang['survey_add_edit_email_description']         = 'Description (Description email)';
$lang['survey_include_survey_link']                = 'Inclure le lien du sondage dans la description';
$lang['survey_available_mail_lists_custom_fields'] = 'Champs personnalisés disponibles à partir des listes emails';
$lang['survey_mail_lists_custom_fields_tooltip']   = 'Les champs personnalisés peuvent être utilisés pour l\'éditeur de la messagerie. Astuce: Cliquez sur l\'éditeur de messagerie, puis sélectionnez le champ dans le menu déroulant pour l\’ajouter automatiquement.';
$lang['survey_add_edit_short_description_view']    = 'Description courte du sondage (Voir la description)';
$lang['survey_add_edit_from']                      = 'De (affiché dans l\'email)';
$lang['survey_add_edit_redirect_url']              = 'URL de redirection du sondage';
$lang['survey_add_edit_red_url_note']              = 'Lorsque l\’utilisateur termine son sondage où doit-il être redirigé (laisser vide pour conserver cette url)';
$lang['survey_add_edit_disabled']                  = 'Désactiver';
$lang['survey_add_edit_only_for_logged_in']        = 'Seulement pour les participants inscrits (collaborateurs, clients)';
$lang['send_survey_string']                        = 'Envoyer le sondage';
$lang['survey_send_mail_list_clients']             = 'Clients';
$lang['survey_send_mail_list_staff']               = 'Collaborateur';
$lang['survey_send_mail_lists_string']             = 'Listes emails';
$lang['survey_send_mail_lists_note_logged_in']     = 'Remarque: si vous envoyez des sondages dans vos mailings seuls les participants connectés doivent être décochés';
$lang['survey_send_string']                        = 'Envoyer';

$lang['survey_send_to_total']  = 'Envoyé à %s emails';
$lang['survey_send_till_now']  = 'Jusqu\'à maintenant';
$lang['survey_send_finished']  = 'Sondages envoyés: %s';
$lang['survey_added_to_queue'] = 'Ce sondage a été ajouté dans la file d\'attente cron le %s';

$lang['survey_questions_string']          = 'Questions';
$lang['survey_insert_field']              = 'Insérer un champ';
$lang['survey_field_checkbox']            = 'Case à cocher';
$lang['survey_field_radio']               = 'Radio';
$lang['survey_field_input']               = 'Champ de texte';
$lang['survey_field_textarea']            = 'Zone de texte';
$lang['survey_question_required']         = 'Requis';
$lang['survey_question_only_for_preview'] = 'Uniquement pour la prévisualisation';
$lang['survey_create_first']              = 'Vous devez premièrement créer le sondage, alors vous serez en mesure d\'insérer les questions.';


$lang['survey_dt_name']               = 'Nom';
$lang['survey_dt_total_questions']    = 'Total Questions';
$lang['survey_dt_total_participants'] = 'Total Participants';
$lang['survey_dt_date_created']       = 'Date de création';
$lang['survey_dt_active']             = 'Actif';

$lang['survey_text_questions_results'] = 'Résultats des questions de texte';
$lang['survey_view_all_answers']       = 'Voir toutes les réponses';

# Staff Tasks
$lang['new_task']       = 'Ajouter une tâche';
$lang['tasks']          = 'Tâches';
$lang['task']           = 'Tâche';
$lang['task_lowercase'] = 'tâche';
$lang['comment_string'] = 'Commentaire';

$lang['task_marked_as_complete'] = 'Tâche marquée comme étant accomplie';
$lang['task_follower_removed']   = 'Tâche du follower supprimée avec succès';
$lang['task_assignee_removed']   = 'Affectation de la tâche supprimée avec succès';

$lang['task_no_assignees'] = 'Aucun collaborateur assigné pour cette tâche';
$lang['task_no_followers'] = 'Aucun follower pour cette tâche';

$lang['task_list_all']            = 'Toutes';
$lang['task_list_finished']       = 'Accomplies';
$lang['task_list_unfinished']     = 'Inachevées';
$lang['task_list_not_assigned']   = 'Non affectées';
$lang['task_list_duedate_passed'] = 'Dates d\'échéance dépassées';
$lang['tasks_dt_name']            = 'Nom';

$lang['task_single_priority']               = 'Priorité';
$lang['task_single_start_date']             = 'Date de début';
$lang['task_single_due_date']               = 'Date de fin';
$lang['task_single_finished']               = 'Accomplie le';
$lang['task_single_mark_as_complete']       = 'Marquer comme accomplie';
$lang['task_single_edit']                   = 'Editer la tâche';
$lang['task_single_delete']                 = 'Supprimer la tâche';
$lang['task_single_assignees']              = 'Collaborateurs assignés';
$lang['task_single_assignees_select_title'] = 'Attribuer la tâche à';
$lang['task_single_followers']              = 'Followers';
$lang['task_single_followers_select_title'] = 'Ajouter un collaborateur';
$lang['task_single_insert_media_link']      = 'Insérer un lien média';
$lang['task_single_add_new_comment']        = 'Ajouter un commentaire';

$lang['task_add_edit_subject']     = 'Sujet';
$lang['task_add_edit_priority']    = 'Priorité';
$lang['task_priority_low']         = 'Basse';
$lang['task_priority_medium']      = 'Moyenne';
$lang['task_priority_high']        = 'Haute';
$lang['task_priority_urgent']      = 'Importante';
$lang['task_add_edit_start_date']  = 'Date de début';
$lang['task_add_edit_due_date']    = 'Date de fin';
$lang['task_add_edit_description'] = 'Description de la tâche';

# Taxes
$lang['new_tax']       = 'Ajouter une taxe';
$lang['taxes']         = 'Taxes';
$lang['tax']           = 'Taxe';
$lang['tax_lowercase'] = 'taxe';
$lang['tax_dt_name']   = 'Nom';
$lang['tax_dt_rate']   = 'Taux (pourcentage)';

$lang['tax_add_edit_name'] = 'Nom';
$lang['tax_add_edit_rate'] = 'Taux (pourcentage)';
$lang['tax_edit_title']    = 'Editer la taxe';
$lang['tax_add_title']     = 'Ajouter une taxe';

# Ticket Statuses
$lang['new_ticket_status']       = 'Nouveau statut ticket';
$lang['ticket_statuses']         = 'Statuts ticket';
$lang['ticket_status']           = 'Statut ticket';
$lang['ticket_status_lowercase'] = 'statut ticket';

$lang['ticket_statuses_dt_name']      = 'Nom du statut ticket';
$lang['no_ticket_statuses_found']     = 'Aucun statut ticket trouvé';
$lang['ticket_statuses_table_total']  = 'Total %s';
$lang['ticket_status_add_edit_name']  = 'Nom du statut ticket';
$lang['ticket_status_add_edit_color'] = 'Choisissez une couleur';
$lang['ticket_status_add_edit_order'] = 'Statut de la commande';

# Todos
$lang['new_todo']                  = 'Nouveau todo';
$lang['my_todos']                  = 'Mes points todos';
$lang['todo']                      = 'Point todo';
$lang['todo_lowercase']            = 'todo';
$lang['todo_status_changed']       = 'Statut todo changé';
$lang['todo_add_title']            = 'Ajouter un nouveau todo';
$lang['add_new_todo_description']  = 'Description';
$lang['no_finished_todos_found']   = 'Aucun todo accompli trouvé';
$lang['no_unfinished_todos_found'] = 'Aucun todo trouvé';
$lang['unfinished_todos_title']    = 'Todos non accomplis';
$lang['finished_todos_title']      = 'Derniers todos accomplis';

# Authentication
$lang['password_changed_email_subject']             = 'Votre mot de passe a été modifié';
$lang['password_reset_email_subject']               = 'Réinitialiser votre mot de passe %s';
# Utilities
$lang['utility_activity_log']                       = 'Journal d\'activité';
$lang['utility_activity_log_filter_by_date']        = 'Filtrer par date';
$lang['utility_activity_log_dt_description']        = 'Description';
$lang['utility_activity_log_dt_date']               = 'Date';
$lang['utility_activity_log_dt_staff']              = 'Collaborateur';
$lang['utility_calendar_new_event_title']           = 'Ajouter un événement';
$lang['utility_calendar_new_event_start_date']      = 'Date de début';
$lang['utility_calendar_new_event_end_date']        = 'Date de fin';
$lang['utility_calendar_new_event_make_public']     = 'Rendre publique';
$lang['utility_calendar_event_added_successfuly']   = 'Nouvel événement ajouté avec succès';
$lang['utility_calendar_event_deleted_successfuly'] = 'événement supprimé';
$lang['utility_calendar_new_event_placeholder']     = 'Titre de l\'événement';


# Navigation
$lang['nav_notifications']          = 'Notifications';
$lang['nav_my_profile']             = 'Mon compte';
$lang['nav_edit_profile']           = 'Editer mon compte';
$lang['nav_logout']                 = 'Déconnexion';
$lang['nav_no_notifications']       = 'Aucune notification trouvée';
$lang['nav_view_all_notifications'] = 'Voir toutes les notifications';
$lang['nav_customizer_tooltip']     = 'Personnaliser les paramètres';
$lang['nav_notifications_tooltip']  = 'Voir les notifications';
## Clients
#

$lang['clients_required_field'] = 'Ce champ est requis';

# Footer
$lang['clients_copyright'] = 'Copyright %s';

# Announcements
$lang['clients_announcement_from']  = 'De : ';
$lang['clients_announcement_added'] = 'Ajouté le : ';

# Contrats
$lang['clients_contracts']               = 'Contrats';
$lang['clients_contracts_dt_subject']    = 'Sujet';
$lang['clients_contracts_dt_start_date'] = 'Date de début';
$lang['clients_contracts_dt_end_date']   = 'Date de fin';

# Home
$lang['clients_quick_invoice_info']                = 'Synthèse de facturation';
$lang['clients_home_currency_select_tooltip']      = 'Vous devez sélectionner une devise car vous avez des factures avec des devises différentes
';
# Factures
$lang['clients_invoice_html_btn_download'] = 'Télécharger';

$lang['clients_my_invoices']        = 'Mes Factures';
$lang['clients_invoice_dt_number']  = 'Numéro';
$lang['clients_invoice_dt_date']    = 'Date de facture';
$lang['clients_invoice_dt_duedate'] = 'Date d\'échéance';
$lang['clients_invoice_dt_amount']  = 'Montant';
$lang['clients_invoice_dt_status']  = 'Statut';

# Profile
$lang['clients_profile_heading'] = 'Profil';

# Used for edit profile and register START
$lang['clients_firstname'] = 'Prénom';
$lang['clients_lastname']  = 'Nom';
$lang['clients_email']     = 'Email';
$lang['clients_company']   = 'Société';
$lang['clients_vat']       = 'Numéro de TVA';
$lang['clients_phone']     = 'Téléphone';
$lang['clients_country']   = 'Pays';
$lang['clients_city']      = 'Ville';
$lang['clients_address']   = 'Adresse';
$lang['clients_zip']       = 'Code Postal';
$lang['clients_state']     = 'Région';

# Used for edit profile and register END

$lang['clients_register_password']        = 'Mot de passe';
$lang['clients_register_password_repeat'] = 'Répéter le mot de passe';
$lang['clients_edit_profile_update_btn']  = 'Mettre à jour';

$lang['clients_edit_profile_change_password_heading'] = 'Changer le mot de passe';
$lang['clients_edit_profile_old_password']            = 'Ancien mot de passe';
$lang['clients_edit_profile_new_password']            = 'Nouveau mot de passe';
$lang['clients_edit_profile_new_password_repeat']     = 'Répéter le mot de passe';
$lang['clients_edit_profile_change_password_btn']     = 'Mettre à jour';
$lang['clients_profile_last_changed_password']        = 'Dernière modification du mot de passe %s';

# Knowledge base
$lang['clients_knowledge_base']                    = 'Aide en ligne';
$lang['clients_knowledge_base_articles_not_found'] = 'Aucun article d\'aide en ligne trouvé';
$lang['clients_knowledge_base_find_useful']        = 'Avez-vous trouvé cet article utile ?';
$lang['clients_knowledge_base_find_useful_yes']    = 'Oui';
$lang['clients_knowledge_base_find_useful_no']     = 'Non';
$lang['clients_article_only_1_vote_today']         = 'Vous ne pouvez voter qu\'une seule fois en 24 heures';
$lang['clients_article_voted_thanks_for_feedback'] = 'Merci pour votre retour';

# Tickets
$lang['clients_ticket_open_subject']                = 'Ouvrir un ticket';
$lang['clients_ticket_open_departments']            = 'Département';
$lang['clients_tickets_heading']                    = 'Support Tickets';
$lang['clients_ticket_open_service']                = 'Service';
$lang['clients_ticket_open_priority']               = 'Priorité';
$lang['clients_latest_tickets']                     = 'Derniers Tickets';
$lang['clients_ticket_open_body']                   = 'Contenu du ticket';
$lang['clients_ticket_attachments']                 = 'Pièces jointes';
$lang['clients_ticket_posted']                      = 'Publié le: %s';
$lang['clients_single_ticket_string']               = 'Ticket';
$lang['clients_single_ticket_replied']              = 'Répondu le: %s';
$lang['clients_single_ticket_informations_heading'] = 'Ticket Informations';

$lang['clients_tickets_dt_number']     = 'Ticket #';
$lang['clients_tickets_dt_subject']    = 'Sujet';
$lang['clients_tickets_dt_department'] = 'Département';
$lang['clients_tickets_dt_service']    = 'Service';
$lang['clients_tickets_dt_status']     = 'Statut';
$lang['clients_tickets_dt_last_reply'] = 'Dernière réponse';


$lang['clients_ticket_single_department']        = 'Department: %s';
$lang['clients_ticket_single_submited']          = 'Soumis: %s';
$lang['clients_ticket_single_status']            = 'Statut:';
$lang['clients_ticket_single_priority']          = 'Priorité: %s';
$lang['clients_ticket_single_add_reply_btn']     = 'Ajouter une réponse';
$lang['clients_ticket_single_add_reply_heading'] = 'Ajouter une réponse pour ce ticket';

# Login
$lang['clients_login_heading_no_register'] = 'Espace client';
$lang['clients_login_heading_register']    = 'Veuillez vous connecter ou vous inscrire';
$lang['clients_login_email']               = 'Email';
$lang['clients_login_password']            = 'Mot de passe';
$lang['clients_login_remember']            = 'Se souvenir de moi';
$lang['clients_login_login_string']        = 'Connexion';

# Register
$lang['clients_register_string']  = 'S\'enregister';
$lang['clients_register_heading'] = 'S\'enregister';

# Navigation
$lang['clients_nav_login']     = 'Login';
$lang['clients_nav_register']  = 'S\'enregister';
$lang['clients_nav_invoices']  = 'Factures';
$lang['clients_nav_contracts'] = 'Contrats';
$lang['clients_nav_kb']        = 'Aide en ligne';
$lang['clients_nav_profile']   = 'Mon compte';
$lang['clients_nav_logout']    = 'Déconnexion';

# Datatables
$lang['clients_dt_paginate_first']    = 'Première';
$lang['clients_dt_paginate_last']     = 'Dernière';
$lang['clients_dt_paginate_next']     = 'Suivante';
$lang['clients_dt_paginate_previous'] = 'Précédente';
$lang['clients_dt_empty_table']       = 'No {0} found';
$lang['clients_dt_search']            = 'Rechercher :';
$lang['clients_dt_zero_records']      = 'Aucun enregistrements correspondants trouvés';
$lang['clients_dt_loading_records']   = 'Chargement...';
$lang['clients_dt_length_menu']       = 'Voir _MENU_ ';
$lang['clients_dt_info_filtered']     = '(filtré à partir de _MAX_ total {0})';
$lang['clients_dt_info_empty']        = 'Affichage de 0 à 0 sur 0 {0}';
$lang['clients_dt_info']              = 'Affichage de _START_ à _END_ sur _TOTAL_ {0}';
$lang['clients_dt_empty_table']       = 'Aucun(e) {0} trouvé(e)';
$lang['clients_dt_sort_ascending']    = 'activer pour trier la colonne ascendante';
$lang['clients_dt_sort_descending']   = 'activer pour trier la colonne descendante';


# Version 1.0.1
# Admin
#
# Règlements
$lang['payment_receipt']                               = 'Reçu de paiement';
$lang['payment_for_string']                            = 'Récapitulatif';
$lang['payment_date']                                  = 'Date du règlement :';
$lang['payment_view_mode']                             = 'Mode de règlement :';
$lang['payment_total_amount']                          = 'Montant du règlement';
$lang['payment_table_invoice_number']                  = 'Numéro';
$lang['payment_table_invoice_date']                    = 'Date de facture';
$lang['payment_table_invoice_amount_total']            = 'Montant de la facture';
$lang['payment_table_payment_amount_total']            = 'Montant du règlement';
$lang['payments_table_transaction_id']                 = 'Transaction ID: %s';
$lang['payment_getaway_token_not_found']               = 'Token introuvable';
$lang['online_payment_recorded_success']               = 'Règlement enregistré avec succès';
$lang['online_payment_recorded_success_fail_database'] = 'Le règlement est validé, mais n\'a pas pu être enregistré dans la base de données, veuillez contacter l\'administrateur.';

# Prospects
$lang['lead_convert_to_client']                   = 'Convertir en client';
$lang['lead_convert_to_email']                    = 'Email';
$lang['lead_convert_to_client_firstname']         = 'Prénom';
$lang['lead_convert_to_client_lastname']          = 'Nom';
$lang['lead_email_already_exists']                = 'L\’Email prospect existe déjà dans les données clients';
$lang['lead_to_client_base_converted_success']    = 'Prospect converti en client';
$lang['lead_already_converted']                   = 'Prospect déjà converti en client';
$lang['lead_have_client_profile']                 = 'Ce prospect a un profil client.';
$lang['lead_converted_edit_client_profile']       = 'Editer le profil';

# Factures
$lang['view_invoice_as_customer_tooltip']                                     = 'Affichage client';
$lang['invoice_add_edit_recurring']                                           = 'Facture récurrente ?';
$lang['invoice_add_edit_recurring_no']                                        = 'Non';
$lang['invoice_add_edit_recurring_month']                                     = 'Tous les %s mois';
$lang['invoice_add_edit_recurring_months']                                    = 'Tous les %s mois';
$lang['invoices_list_all']                                                    = 'Toutes';
$lang['invoices_list_not_sent']                                               = 'Facture non envoyée';
$lang['invoices_list_not_have_payment']                                       = 'Factures with no payment record';
$lang['invoices_list_recuring']                                               = 'Factures récurrentes';
$lang['invoices_list_made_payment_by']                                        = 'Paiement effectué par %s';
$lang['invoices_create_invoice_from_recurring_only_on_paid_invoices']         = 'Créer une nouvelle facture sur la base de la facture récurrente seulement si celle-ci a le statut “payée”';
$lang['invoices_create_invoice_from_recurring_only_on_paid_invoices_tooltip'] = 'Pour créer une nouvelle facture sur la base de la facture récurrente seulement si la facture principale a le statut “payée”? Si vous sélectionnez l\’option NON et que la facture récurrente n\’a pas le statut « payée », la nouvelle facture ne sera pas créée.';
$lang['send_renewed_invoice_from_recurring_to_email']                         = 'Envoyer automatiquement la facture de renouvellement au client';
$lang['view_invoice_pdf_link_pay']                                            = 'Régler la facture';

# Payment modes
$lang['payment_mode_add_edit_description']         = 'Coordonnées bancaires / Description';
$lang['payment_mode_add_edit_description_tooltip'] = 'Vous pouvez renseigner ici les coordonnées bancaires. Elles seront affichées sur les factures en ligne';
$lang['payment_modes_dt_description']              = 'Coordonnées bancaires / Description';
$lang['payment_modes_add_edit_announcement']       = 'Remarque : Les modes de règlement indiqués ci-dessous concernent les modes hors ligne. Les modes de règlement en ligne peuvent être configurés dans : Paramètres -> Configuration -> Passerelles de paiement.';
$lang['payment_mode_add_edit_active']              = 'Actif';
$lang['payment_modes_dt_active']                   = 'Actif';

# Contrats
$lang['contract_not_found'] = 'Contract introuvable. Veuillez verifier dans le journal d\'activité si celui-ci n\'a pas été supprimé';

# Settings
$lang['setting_bar_heading']                 = 'Paramètres';
$lang['settings_group_online_payment_modes'] = 'Passerelles de paiements';
$lang['settings_paymentmethod_mode_label']   = 'Etiquette';
$lang['settings_paymentmethod_active']       = 'Activer';
$lang['settings_paymentmethod_currencies']   = 'Devise (séparée par une virgule)';
$lang['settings_paymentmethod_testing_mode'] = 'Activer le mode test';

$lang['settings_paymentmethod_paypal_username']  = 'Identifiant API Paypal';
$lang['settings_paymentmethod_paypal_password']  = 'Mot de passe API Paypal';
$lang['settings_paymentmethod_paypal_signature'] = 'Signature API';

$lang['settings_paymentmethod_stripe_api_secret_key']      = 'Clé secrète API Stripe';
$lang['settings_paymentmethod_stripe_api_publishable_key'] = 'Clé publique Stripe';
$lang['settings_limit_top_search_bar_results']             = 'Nombre limite de résultats dans la barre de recherche';

# Quick Actions
$lang['qa_create_invoice']  = 'Créer une facture';
$lang['qa_create_task']     = 'Ajouter une tâche';
$lang['qa_create_client']   = 'Ajouter un client';
$lang['qa_create_contract'] = 'Ajouter un contrat';
$lang['qa_create_kba']      = 'Ajouter un article (aide en ligne)';
$lang['qa_create_survey']   = 'Créer un sondage';
$lang['qa_create_ticket']   = 'Ouvrir un ticket';
$lang['qa_create_staff']    = 'Ajouter un collaborateur';

## Clients
$lang['client_phonenumber'] = 'Téléphone';

# Main Clients
$lang['clients_register']                          = 'Inscription';
$lang['clients_profile_updated']                   = 'Votre profil a été mis à jour';
$lang['clients_successfully_registered']           = 'Merci de votre inscription';
$lang['clients_account_created_but_not_logged_in'] = 'Votre compte a été créé, mais vous n\'êtes pas automatiquement connecté dans notre système. Veuillez essayer de vous connecter.';
# Tickets
$lang['clients_tickets_heading']                   = 'Support Tickets';

# Payments
// Uses on stripe page
$lang['payment_for_invoice'] = 'Règlement de la facture';
$lang['payment_total']       = 'Total: %s';

# Invoice
$lang['invoice_html_online_payment']             = 'Paiement en ligne';
$lang['invoice_html_online_payment_button_text'] = 'Payer maintenant';
$lang['invoice_html_payment_modes_not_selected'] = 'Veuillez sélectionner un mode de règlement';
$lang['invoice_html_amount_blank']               = 'Le montant total ne peut pas être vide ou à zéro';
$lang['invoice_html_offline_payment']            = 'Règlement hors ligne';
$lang['invoice_html_amount']                     = 'Montant';


# Version 1.0.2
# Admin
#
# DataTables
$lang['dt_button_column_visibility']  = 'Affichage';
$lang['dt_button_reload']             = 'Actualiser';
$lang['dt_button_excel']              = 'Excel';
$lang['dt_button_csv']                = 'CSV';
$lang['dt_button_pdf']                = 'PDF';
$lang['dt_button_print']              = 'Imprimer';
$lang['is_not_active_export']         = 'Non';
$lang['is_active_export']             = 'Oui';

# Invoice
$lang['invoice_add_edit_advanced_options']               = 'Options avancées';
$lang['invoice_add_edit_allowed_payment_modes']          = 'Autoriser les moyens de règlement pour cette facture';
$lang['invoice_add_edit_recuring_invoices_from_invoice'] = 'Factures récurrentes de cette facture';
$lang['invoice_add_edit_no_payment_modes_found']         = 'Aucun moyens de règlement trouvés.';
$lang['invoice_html_total_pay']                          = 'Total: %s';

# Email templates
$lang['email_templates_table_heading_name'] = 'Liste des modèles';
# General
$lang['discount_type']                      = 'Type de remise';
$lang['discount_type_after_tax']            = 'Après la taxe';
$lang['discount_type_before_tax']           = 'Avant la taxe';
$lang['terms_and_conditions']               = 'Termes & Conditions';
$lang['reference_no']                       = 'Référence';
$lang['no_discount']                        = 'Aucune remise';
$lang['view_stats_tooltip']                 = 'Voir l\'analyse de la facturation';
# Clients
$lang['zip_from_date']                      = 'A partir de la date:';
$lang['zip_to_date']                        = 'Jusqu\'à la date:';
$lang['client_zip_payments']                = 'Règlements ZIP';
$lang['client_zip_invoices']                = 'Factures ZIP';
$lang['client_zip_estimates']               = 'Devis ZIP ';
$lang['client_zip_status']                  = 'Statut';
$lang['client_zip_status_all']              = 'Tous';
$lang['client_zip_payment_modes']           = 'Règlement effectué par:';
$lang['client_zip_no_data_found']           = 'Aucun(e) %s trouvé(e)';

# Payments
$lang['payment_mode']         = 'Mode de règlement';
$lang['payment_view_heading'] = 'Règlement';

# Settings
$lang['settings_allow_payment_amount_to_be_modified']               = 'Autoriser les clients à modifier le montant à régler (pour les paiements en ligne)';
$lang['settings_survey_send_emails_per_cron_run']                   = 'Nombre d\'emails à envoyer par heure (Sondages)';
$lang['settings_survey_send_emails_per_cron_run_tooltip']           = 'Cettte option est utilisée lors de l\'envoi des sondages. La tâche cron des sondages s\'exécute toutes les 5 minutes. Vous pouvez par conséquent définir le nombre d\'emails à envoyer toutes les 5 minutes';
$lang['settings_delete_only_on_last_invoice']                       = 'Autoriser la supression d\'une facture uniquement sur la dernière facture';
$lang['settings_sales_estimate_prefix']                             = 'Préfixe numéro de devis';
$lang['settings_sales_next_estimate_number']                        = 'Prochain numéro de devis';
$lang['settings_sales_next_estimate_number_tooltip']                = 'Réglez ce champ sur 1 si vous voulez commencer à partir du début';
$lang['settings_sales_decrement_estimate_number_on_delete']         = 'Décrémenter le numéro de facture lors de la suppression';
$lang['settings_sales_decrement_estimate_number_on_delete_tooltip'] = 'Voulez-vous décrémenter le numéro de facture lorsque la dernière facture est supprimée ?  Ex. Si vous sélectionnez cette option sur OUI, la facture numéro 15 supprimée, le prochain numéro de facture sera le 14. Si vous sélectionnez  cette option sur NON la prochaine facture gardera le numéro 15.';
$lang['settings_sales_estimate_number_format']                      = 'Format de numérotation des devis';
$lang['settings_sales_estimate_number_format_year_based']           = 'Année et base de numéro';
$lang['settings_sales_estimate_number_format_number_based']         = 'Base de numéro (000001)';
$lang['settings_sales_estimate_year']                               = 'Année de facturation (AAAA/000001)';
$lang['settings_sales_estimate_year_tooltip']                       = 'Affiche l\'année courante. Le numéro séquentiel sera réinitialisé chaque année.';
$lang['settings_delete_only_on_last_estimate']                      = 'Autoriser la supression d\'un devis uniquement sur le dernier devis';
$lang['settings_cron_invoice_heading']                              = 'Facture';
$lang['settings_send_test_email_heading']                           = 'Envoyer un email test';
$lang['settings_send_test_email_subheading']                        = 'Envoyer un email test afin de vous assurer que vos paramètres SMTP sont correctement définis.';
$lang['settings_send_test_email_string']                            = 'Adresse Email Test';
$lang['settings_smtp_settings_heading']                             = 'Paramètres SMTP';
$lang['settings_smtp_settings_subheading']                          = 'Configuration de l\'email principal';
$lang['settings_sales_heading_general']                             = 'Général';
$lang['settings_sales_heading_invoice']                             = 'Facture';
$lang['settings_sales_heading_estimates']                           = 'Devis';
$lang['settings_sales_heading_company']                             = 'Informations société';
$lang['settings_sales_cron_invoice_heading']                        = 'Facture';

# Tasks
$lang['tasks_dt_datestart'] = 'Date de début';
$lang['tasks_dt_priority']  = 'Priorité';

# Invoice General
$lang['invoice_discount'] = 'Remise';

# Tickets
$lang['ticket_settings_client'] = 'Client';

# Settings
$lang['settings_rtl_support_admin']                                   = 'RTL Espace Admin (de droite à gauche)';
$lang['settings_rtl_support_client']                                  = 'RTL Espace Client (de droite à gauche)';
$lang['acs_language_editor']                                          = 'Editeur de langue';
$lang['settings_estimate_auto_convert_to_invoice_on_client_accept']   = 'Convertir automatiquement les devis en facture après la validation du client';
$lang['settings_exclude_estimate_from_client_area_with_draft_status'] = 'Exclure les devis avec le statut brouillon de l\'espace client';

# Months
$lang['January']   = 'Janvier';
$lang['February']  = 'Février';
$lang['March']     = 'Mars';
$lang['April']     = 'Avril';
$lang['May']       = 'Mai';
$lang['June']      = 'Juin';
$lang['July']      = 'Juillet';
$lang['August']    = 'Août';
$lang['September'] = 'Septembre';
$lang['October']   = 'Octobre';
$lang['November']  = 'Novembre';
$lang['December']  = 'Décembre';

# Time ago function translate
$lang['time_ago_just_now']  = 'A l\'instant';
$lang['time_ago_minute']    = 'Il y a 1 minute';
$lang['time_ago_minutes']   = 'Il y a %s minutes';
$lang['time_ago_hour']      = 'Il y a 1 heure';
$lang['time_ago_hours']     = 'Il y a %s heures';
$lang['time_ago_yesterday'] = 'hier';
$lang['time_ago_days']      = 'Il y a %s jours';
$lang['time_ago_week']      = 'Il y a 1 semaine';
$lang['time_ago_weeks']     = 'Il y a %s semaines';
$lang['time_ago_month']     = 'Il y a 1 mois';
$lang['time_ago_months']    = 'Il y a %s mois';
$lang['time_ago_year']      = 'Il y a 1 an';
$lang['time_ago_years']     = 'Il y a %s ans';


# Devis
$lang['estimates']                          = 'Devis';
$lang['estimate']                           = 'Devis';
$lang['estimate_lowercase']                 = 'devis';
$lang['create_new_estimate']                = 'Créer un devis';
$lang['view_estimate']                      = 'Voir le devis';
$lang['estimate_sent_to_client_success']    = 'Devis envoyé au client avec succès';
$lang['estimate_sent_to_client_fail']       = 'Problème lors de l\'envoi du devis';
$lang['estimate_reminder_send_problem']     = 'Problème lors de l\'envoi de la relance devis';
$lang['estimate_details']                   = 'Details du devis';
$lang['estimate_view']                      = 'Voir le devis';
$lang['estimate_select_customer']           = 'Client';
$lang['estimate_add_edit_number']           = 'Devis Numéro';
$lang['estimate_add_edit_date']             = 'Date de devis';
$lang['estimate_add_edit_expirydate']       = 'Date de validité';
$lang['estimate_add_edit_currency']         = 'Devise';
$lang['estimate_add_edit_client_note']      = 'Note Client';
$lang['estimate_add_edit_admin_note']       = 'Note Admin';
$lang['estimate_add_edit_new_item']         = 'Nouveau point';
$lang['estimate_add_edit_search_item']      = 'Recherche le point';
$lang['estimates_toggle_table_tooltip']     = 'Afficher le tableau complet';
$lang['estimate_add_edit_advanced_options'] = 'Options avancées';
$lang['estimate_vat']                       = 'Numéro de TVA';
$lang['estimate_to']                        = 'À';
$lang['estimates_list_all']                 = 'Tous';

$lang['estimate_invoiced_date']                  = 'Devis facturé le %s';
$lang['edit_estimate_tooltip']                   = 'Editer le devis';
$lang['delete_estimate_tooltip']                 = 'Supprimer';
$lang['estimate_sent_to_email_tooltip']          = 'Envoyer par email';
$lang['estimate_already_send_to_client_tooltip'] = 'Ce devis a déjà été envoyé au client %s';
$lang['send_overdue_notice_tooltip']             = 'Envoyer un avis de retard';
$lang['estimate_view_activity_tooltip']          = 'Historique du devis';

$lang['estimate_send_to_client_modal_heading']    = 'Envoyer ce devis au client';
$lang['estimate_send_to_client_attach_pdf']       = 'Joindre la version PDF';
$lang['estimate_send_to_client_preview_template'] = 'Aperçu du modèle d\'email';

$lang['estimate_dt_table_heading_number']     = 'Numéro';
$lang['estimate_dt_table_heading_date']       = 'Date de devis';
$lang['estimate_dt_table_heading_client']     = 'Client';
$lang['estimate_dt_table_heading_expirydate'] = 'Date de validité';
$lang['estimate_dt_table_heading_amount']     = 'Montant';
$lang['estimate_dt_table_heading_status']     = 'Statut';

$lang['estimate_email_link_text']    = 'Voir le devis';
$lang['estimate_convert_to_invoice'] = 'Convertir en facture';
# Home
$lang['home_unfinished_tasks']       = 'Tâches inachevées';

# Clients
$lang['client_estimates_tab'] = 'Devis';
$lang['client_payments_tab']  = 'Règlements';


# Estimate General
$lang['estimate_pdf_heading']            = 'DEVIS';
$lang['estimate_table_item_heading']     = 'Désignation';
$lang['estimate_table_quantity_heading'] = 'Qté.';
$lang['estimate_table_rate_heading']     = 'Prix unitaire';
$lang['estimate_table_tax_heading']      = 'Taxe';
$lang['estimate_table_amount_heading']   = 'Montant HT';
$lang['estimate_subtotal']               = 'Total HT';
$lang['estimate_adjustment']             = 'Ajustement';
$lang['estimate_discount']               = 'Remise';
$lang['estimate_total']                  = 'Total TTC';
$lang['estimate_to']                     = 'À';
$lang['estimate_data_date']              = 'Date de devis';
$lang['estimate_data_expiry_date']       = 'Date de validité';
$lang['estimate_note']                   = 'Note:';
$lang['estimate_status_draft']           = 'Brouillon';
$lang['estimate_status_sent']            = 'Envoyé';
$lang['estimate_status_declined']        = 'Decliné';
$lang['estimate_status_accepted']        = 'Accepté';
$lang['estimate_status_expired']         = 'Expiré';
$lang['estimate_note']                   = 'Note:';

# Quick create
$lang['qa_create_estimate'] = 'Créer un devis';
$lang['qa_create_lead']     = 'Ajouter un prospect';


## Clients
$lang['clients_estimate_dt_number']             = 'Numéro';
$lang['clients_estimate_dt_date']               = 'Date de devis';
$lang['clients_estimate_dt_duedate']            = 'Date de validité';
$lang['clients_estimate_dt_amount']             = 'Montant';
$lang['clients_estimate_dt_status']             = 'Statut';
$lang['clients_nav_estimates']                  = 'Devis';
$lang['clients_decline_estimate']               = 'Decliné';
$lang['clients_accept_estimate']                = 'Accepté';
$lang['clients_my_estimates']                   = 'Devis';
$lang['clients_estimate_invoiced_successfuly']  = 'Devis accepté. Voici la facture de ce devis';
$lang['clients_estimate_accepted_not_invoiced'] = 'Nous vous remercions d\'avoir accepté ce devis';
$lang['clients_estimate_declined']              = 'Devis décliné. Vous pouvez accepter ce devis à tout moment avant la date d\'expiration';
$lang['clients_estimate_failed_action']         = 'Impossible de prendre une décision sur ce devis';
$lang['client_add_edit_profile']                = 'Profil';

# Version 1.0.3
# Admin
# Home
$lang['home_invoice_not_sent']        = 'Factures non envoyées';
$lang['home_expired_estimates']       = 'Devis Expirés';
$lang['home_invoice_overdue']         = 'Factures échues';

# Reports

# Champs personnalisés
$lang['custom_field']                          = 'Champ personnalisé';
$lang['custom_field_lowercase']                = 'champ personnalisé';
$lang['custom_fields']                         = 'Champs personnalisés';
$lang['custom_fields_lowercase']               = 'champs personnalisés';
$lang['new_custom_field']                      = 'Ajouter un champ';
$lang['custom_field_name']                     = 'Nom du champ';
$lang['custom_field_add_edit_type']            = 'Type de champ';
$lang['custom_field_add_edit_belongs_top']     = 'Champ lié à';
$lang['custom_field_add_edit_options']         = 'Options';
$lang['custom_field_add_edit_options_tooltip'] = 'Option pour les menus déroulants. Renseigner ce champ en séparant les options par une virgule. Ex. pomme,orange,banane';
$lang['custom_field_add_edit_order']           = 'Ordre';

$lang['custom_field_dt_field_to']       = 'Appartient à';
$lang['custom_field_dt_field_name']     = 'Nom';
$lang['custom_field_dt_field_type']     = 'Type';
$lang['custom_field_add_edit_active']   = 'Actif';
$lang['custom_field_add_edit_disabled'] = 'Désactiver';

# Ticket replies
$lang['ticket_reply']           = 'Réponse ticket';
$lang['ticket_reply_lowercase'] = 'réponse ticket';

# Admin Customizer Sidebar
$lang['asc_custom_fields'] = 'Champs personnalisés';

# Contrats
$lang['contract_types']          = 'Types de contrats';
$lang['contract_type']           = 'Type de contrat';
$lang['new_contract_type']       = 'Nouveau type de contrat';
$lang['contract_type_lowercase'] = 'contrat';
$lang['contract_type_name']      = 'Nom';

$lang['contract_types_list_name'] = 'Type de contrat';

# Customizer Menu
$lang['acs_contracts']      = 'Contrats';
$lang['acs_contract_types'] = 'Types de contrats';

# Version 1.0.4
# Invoice Items
$lang['invoice_item_long_description']     = 'Description';
# Clients
$lang['client_delete_invoices_warning']    = 'Ce client a des factures ou devis existants. Vous ne pouvez pas supprimer ce client. Vous devez d’abord attribuer les factures ou devis à un autre client avant de le supprimer.';
$lang['clients_list_phone']                = 'Téléphone';
$lang['client_expenses_tab']               = 'Dépenses';
$lang['customers_summary']                 = 'Synthèse des Clients';
$lang['customers_summary_active']          = 'Actifs';
$lang['customers_summary_inactive']        = 'Inactifs';
$lang['customers_summary_logged_in_today'] = 'Connectés aujourd\'hui';

# Authentification
$lang['admin_auth_forgot_password_email']             = 'Email';
$lang['admin_auth_forgot_password_heading']           = 'Mot de passe oublié';
$lang['admin_auth_login_heading']                     = 'Connexion';
$lang['admin_auth_login_email']                       = 'Email';
$lang['admin_auth_login_password']                    = 'Mot de passe';
$lang['admin_auth_login_remember_me']                 = 'Se souvenir de moi';
$lang['admin_auth_login_button']                      = 'Connexion';
$lang['admin_auth_login_fp']                          = 'Mot de passe oublié ?';
$lang['admin_auth_login_auth']                        = 'Aller à ouvrir une session ?';
$lang['admin_auth_reset_password_heading']            = 'Réinitialiser le mot de passe';
$lang['admin_auth_reset_password']                    = 'Mot de passe';
$lang['admin_auth_reset_password_repeat']             = 'Répéter le mot de passe';
$lang['admin_auth_invalid_email_or_password']         = 'Email ou mot de passe invalide';
$lang['admin_auth_inactive_account']                  = 'Compte inactif';
# Calendrier
$lang['calendar_estimate']                            = 'Devis';
$lang['calendar_invoice']                             = 'Facture';
$lang['calendar_contract']                            = 'Contrat';
$lang['calendar_customer_reminder']                     = 'Rappel client';
$lang['calendar_event']                               = 'Evenement';
$lang['calendar_task']                                = 'Tâche';
# Prospects
$lang['lead_edit_delete_tooltip']                     = 'Supprimer';
$lang['lead_attachments']                             = 'Pièces jointes';
# Admin Customizer Sidebar
$lang['acs_finance']                                  = 'Finance';
# Settings
$lang['new_company_field_info']                       = 'Ce champ sera affiché sur les factures/devis sur l\'encart réservé à la société (à gauche). Vous n\'êtes pas autorisé à ajouter des caractères (point, virgules, signes etc.)dans le champ NOM.';
$lang['new_company_field_name']                       = 'Champ NOM';
$lang['new_company_field_value']                      = 'Champ valeur';
$lang['new_company_field']                            = 'Ajouter un champ personnalisé';
$lang['settings_number_padding_invoice_and_estimate'] = 'Longueur des numéros (factures / devis). <br /> <small>Ex. Si la valeur est réglée à 3, le nombre sera formaté comme ceci : 005 ou 025</small>';
$lang['settings_show_sale_agent_on_invoices']         = 'Indiquer le contact commercial sur les factures';
$lang['settings_show_sale_agent_on_estimates']        = 'Indiquer le contact commercial sur les devis';
$lang['settings_predefined_predefined_term']          = 'Termes et conditions générales par défaut';
$lang['settings_predefined_clientnote']               = 'Note client par défaut';
$lang['settings_custom_pdf_logo_image_url']           = 'Lien URL du logo personnalisé pour les documents PDF (JPG - 210x60px)';
$lang['settings_custom_pdf_logo_image_url_tooltip']   = 'Vous aurez probablement des problèmes avec les images de type PNG. L\'affichage de la transparence varie différemment en fonction de la version de php-imagick ou de php-gd utilisée. Essayez de mettre à jour php-imagick et désactivez php-gd. Si vous laissez ce champ vide le logo téléchargé sera utilisé par défaut.';

# General
$lang['sale_agent_string']               = 'Contact commercial';
$lang['amount_display_in_base_currency'] = 'Le montant est affiché dans votre devise de base';

# Prospects
$lang['leads_summary']                                         = 'Synthèse des prospects';

# Contrats
$lang['contract_value']                 = 'Valeur du contrat';
$lang['contract_trash']                 = 'Corbeille';
$lang['contracts_view_trash']           = 'Voir la corbeille';
$lang['contracts_view_all']             = 'Tous';
$lang['contracts_view_exclude_trashed'] = 'Exclure les contrats mis à la corbeille';
$lang['contract_value_tooltip']         = 'Ajouter la valeur du contrat. La valeur sera affichée dans votre devise de base.';
$lang['contract_trash_tooltip']         = 'Si vous ajoutez le contrat à la corbeille, il ne sera pas affiché sur l\'espace client, ni inclu dans le tableau et autres statistiques. Il ne sera pas affiché par défaut lorsque vous aurez la liste de tous les contrats.';

$lang['contract_renew_heading']               = 'Renouveler le contrat';
$lang['contract_summary_heading']             = 'Synthèse des contrats';
$lang['contract_summary_expired']             = 'Expiré';
$lang['contract_summary_active']              = 'Actif';
$lang['contract_summary_about_to_expire']     = 'Sur le point d\'expirer';
$lang['contract_summary_recently_added']      = 'Récemment ajouté';
$lang['contract_summary_trash']               = 'Corbeille';
$lang['contract_summary_by_type']             = 'Contrats par type';
$lang['contract_summary_by_type_value']       = 'Valeur contrats par type';
$lang['contract_renewed_successfuly']         = 'Contrat renouvelé avec succès';
$lang['contract_renewed_fail']                = 'Problème lors du renouvellement du contrat. Veuillez contacter l\'administrateur';
$lang['no_contract_renewals_found']           = 'Le renouvellement du contrat est introuvable';
$lang['no_contract_renewals_history_heading'] = 'Historique des contrats renouvelés';
$lang['contract_renewed_by']                  = '%s a renouvelé ce contrat';
$lang['contract_renewal_deleted']             = 'Renouvellement supprimé';
$lang['contract_renewal_delete_fail']         = 'Echec de la supression du contrat renouvelé. Veuillez contacter l\'administrateur';

$lang['contract_renewal_new_value'] = 'Nouvelle valeur du contrat: %s';
$lang['contract_renewal_old_value'] = 'Ancienne valeur du contrat: %s';

$lang['contract_renewal_new_start_date'] = 'Nouvelle date de début du contrat: %s';
$lang['contract_renewal_old_start_date'] = 'L\'ancienne date de début du contrat était: %s';

$lang['contract_renewal_new_end_date'] = 'Nouvelle date de fin du contrat: %s';
$lang['contract_renewal_old_end_date'] = 'L\'ancienne date de fin du contrat était: %s';
$lang['contract_attachment']           = 'Pièce jointe';
$lang['contract_attachment_lowercase'] = 'pièce jointe';

# Admin Aside Menu
$lang['als_goals_tracking']     = 'Objectifs';
$lang['als_expenses']           = 'Dépenses';
$lang['als_reports_expenses']   = 'Dépenses';
$lang['als_expenses_vs_income'] = 'Dépenses vs Ventes';

# Factures
$lang['invoice_attach_file']           = 'Pièce jointe';
$lang['invoice_mark_as_sent']          = 'Marquer comme envoyée';
$lang['invoice_marked_as_sent']        = 'Facture marquée comme envoyée';
$lang['invoice_marked_as_sent_failed'] = 'Echec pour marquer la facture comme envoyée';

# Quick Actions
$lang['qa_new_goal']    = 'Ajouter un objectif';
$lang['qa_new_expense'] = 'Enregistrer une dépense';

# Goals Tracking
$lang['goals']                                         = 'Objectifs';
$lang['goal']                                          = 'Objectif';
$lang['goals_tracking']                                = 'Suivi des objectifs';
$lang['new_goal']                                      = 'Ajouter un objectif';
$lang['goal_lowercase']                                = 'objectif';
$lang['goal_start_date']                               = 'Date de début';
$lang['goal_end_date']                                 = 'Date de fin';
$lang['goal_subject']                                  = 'Sujet';
$lang['goal_description']                              = 'Description';
$lang['goal_type']                                     = 'Type d\'objectif';
$lang['goal_achievement']                              = 'Nombre de réussites';
$lang['goal_contract_type']                            = 'Type de contrat';
$lang['goal_notify_when_fail']                         = 'Avertir les membres de l\'équipe lorsque l\'objectif n\'a pas été atteint';
$lang['goal_notify_when_achieve']                      = 'Avertir les membres de l\'équipe lorsque l\'objectif est atteint';
$lang['goal_progress']                                 = 'Progression';
$lang['goal_total']                                    = 'Total: %s';
$lang['goal_result_heading']                           = 'Progression de l\'objectif';
$lang['goal_income_shown_in_base_currency']            = 'Le revenu total est indiqué dans votre devise de base';
$lang['goal_notify_when_end_date_arrives']             = 'Les collaborateurs recevront une notification avant la date d\'échéance.';
$lang['goal_staff_members_notified_about_achievement'] = 'Les collaborateurs sont informés de la réussite de cet objectif';
$lang['goal_staff_members_notified_about_failure']     = 'Les collaborateurs sont informés de l\'échec de cet objectif';
$lang['goal_notify_staff_manualy']                     = 'Informer les collaborateurs manuellement';
$lang['goal_notify_staff_notified_manualy_success']    = 'Les collaborateurs sont informés des résultats de cet objectif';
$lang['goal_notify_staff_notified_manualy_fail']       = 'Echec lors de l\'envoi des résultats de cet objectif aux collaborateurs';

$lang['goal_achieved'] = 'Atteint';
$lang['goal_failed']   = 'Échoué';
$lang['goal_close']    = 'Très proche';

$lang['goal_type_total_income']                                         = 'Atteindre le revenu total';
$lang['goal_type_convert_leads']                                        = 'Convertir X Prospects';
$lang['goal_type_increase_customers_without_leads_conversions']         = 'Augmenter le nombre de client';
$lang['goal_type_increase_customers_without_leads_conversions_subtext'] = 'Prospects Conversion is Excluded';

$lang['goal_type_increase_customers_with_leads_conversions']         = 'Augmentation du nombre de clients';
$lang['goal_type_increase_customers_with_leads_conversions_subtext'] = 'Les conversions clients sont incluses';
$lang['goal_type_make_contracts_by_type_calc_database']              = 'Réaliser des contrats par type';
$lang['goal_type_make_contracts_by_type_calc_database_subtext']      = 'Est calculé à partir de la date ajoutée à la base de données';
$lang['goal_type_make_contracts_by_type_calc_date']                  = 'Réaliser des contrats par type';
$lang['goal_type_make_contracts_by_type_calc_date_subtext']          = 'Est calculé à partir de la date de début du contrat';
$lang['goal_type_total_estimates_converted']                         = 'Convertir X Devis';
$lang['goal_type_total_estimates_converted_subtext']                 = 'Seront pris en compte seulement les devis qui seront convertis en factures';
$lang['goal_type_income_subtext']                                    = 'Le revenu sera calculé dans votre base de devise (non convertie)';
# Payments
$lang['payment_transaction_id']                                      = 'Référence de transaction';
# Settings Menu
$lang['acs_expenses']                                                = 'Dépenses';
$lang['acs_expense_categories']                                      = 'Catégories de dépenses';
# Dépenses
$lang['expense_category']                                            = 'Catégorie de dépenses';
$lang['expense_category_lowercase']                                  = 'catégorie de dépenses';
$lang['new_expense']                                                 = 'Enregistrer une dépense';
$lang['expense_add_edit_name']                                       = 'Nom de la catégorie';
$lang['expense_add_edit_description']                                = 'Description';
$lang['expense_categories']                                          = 'Catégories de dépenses';
$lang['new_expense_category']                                        = 'Ajouter une catégorie';
$lang['dt_expense_description']                                      = 'Description';
$lang['expense']                                                     = 'Dépense';
$lang['expenses']                                                    = 'Dépenses';
$lang['expense_lowercase']                                           = 'dépense';
$lang['expense_add_edit_tax']                                        = 'Taxe';
$lang['expense_add_edit_customer']                                   = 'Client';
$lang['expense_add_edit_currency']                                   = 'Devise';
$lang['expense_add_edit_note']                                       = 'Note';
$lang['expense_add_edit_date']                                       = 'Date de la dépense';
$lang['expense_add_edit_amount']                                     = 'Montant';
$lang['expense_add_edit_billable']                                   = 'Facturable';
$lang['expense_add_edit_attach_receipt']                             = 'Joindre un reçu';
$lang['expense_add_edit_reference_no']                               = 'Référence';
$lang['expense_receipt']                                             = 'Reçu de dépense';
$lang['expense_receipt_lowercase']                                   = 'reçu de dépense';
$lang['expense_dt_table_heading_category']                           = 'Catégorie';
$lang['expense_dt_table_heading_amount']                             = 'Montant';
$lang['expense_dt_table_heading_date']                               = 'Date';
$lang['expense_dt_table_heading_reference_no']                       = 'Référence';
$lang['expense_dt_table_heading_customer']                           = 'Client';
$lang['expense_dt_table_heading_payment_mode']                       = 'Mode de règlement';
$lang['expense_converted_to_invoice']                                = 'Dépense convertie en facture avec succès';
$lang['expense_converted_to_invoice_fail']                           = 'Échec de la conversion de cette dépense à facturer. Vérifiez le journal des erreurs.';
$lang['expense_copy_success']                                        = 'Dépense copiéé avec succès.';
$lang['expense_copy_fail']                                           = 'Échec de la copie dépenses. Vérifiez les champs requis et essayez à nouveau.';
$lang['expenses_list_all']                                           = 'Toutes';
$lang['expenses_list_billable']                                      = 'Facturable';
$lang['expenses_list_non_billable']                                  = 'Non Facturables';
$lang['expenses_list_invoiced']                                      = 'Facturées';
$lang['expenses_list_unbilled']                                      = 'Non Facturée';
$lang['expenses_list_recurring']                                     = 'Récurrentes';
$lang['expense_invoice_delete_not_allowed']                          = 'Impossible de supprimer cette dépense. Celle-ci a déjà été facturée.';
$lang['expense_convert_to_invoice']                                  = 'Convertir en facture';
$lang['expense_edit']                                                = 'Editer la dépense';
$lang['expense_delete']                                              = 'Supprimer';
$lang['expense_copy']                                                = 'Copier';
$lang['expense_invoice_not_created']                                 = 'Facture non créée';
$lang['expense_billed']                                              = 'Facturée';
$lang['expense_not_billed']                                          = 'Non facturée';
$lang['expense_customer']                                            = 'Client';
$lang['expense_note']                                                = 'Note:';
$lang['expense_date']                                                = 'Date:';
$lang['expense_ref_noe']                                             = 'Ref #:';
$lang['expense_tax']                                                 = 'Taxe :';
$lang['expense_amount']                                              = 'Montant :';
$lang['expense_recurring_indicator']                                 = 'Récurrent';
$lang['expense_already_invoiced']                                    = 'Cette dépense est déjà facturée';
$lang['expense_recurring_auto_create_invoice']                       = 'Création automatique de la facture';
$lang['expense_recurring_send_custom_on_renew']                      = 'Envoyer la facture au client quand la dépense est récurrente';
$lang['expense_recurring_autocreate_invoice_tooltip']                = 'Si cette option est cochée la facture pour le client sera automatiquement créée lors du renouvellement de la dépense.';
$lang['report_expenses_full']                                        = 'Rapport complet';
$lang['expenses_yearly_by_categories']                               = 'Dépenses annuelles par catégories';
$lang['total_expenses_for']                                          = 'Total Dépenses pour'; // année
$lang['expenses_report_for']                                         = 'Dépenses pour'; // année
# Custom fields
$lang['custom_field_required']                                       = 'Requis';
$lang['custom_field_show_on_pdf']                                    = 'Afficher sur les documents PDF';
$lang['custom_field_leads']                                          = 'Prospects';
$lang['custom_field_customers']                                      = 'Clients';
$lang['custom_field_staff']                                          = 'Collaborateurs';
$lang['custom_field_contracts']                                      = 'Contrats';
$lang['custom_field_tasks']                                          = 'Tâches';
$lang['custom_field_expenses']                                       = 'Dépenses';
$lang['custom_field_invoice']                                        = 'Facture';
$lang['custom_field_estimate']                                       = 'Devis';
# Tickets
$lang['ticket_single_private_staff_notes']                           = 'Notes privées collaborateurs';


# Business News
$lang['business_news'] = 'Business News';

# Navigation
$lang['nav_todo_items']               = 'Articles todos';
# Clients
# Contrats
$lang['clients_contracts_type']       = 'Type de contrat';


# Version 1.0.5
# General
$lang['no_tax']                             = 'Aucune taxe';
$lang['numbers_not_formated_while_editing'] = 'Le taux dans le champ de saisie est non formatable et doit rester non formaté. Ne pas essayer de la formater manuellement.';
# Contrats
$lang['contracts_view_expired']             = 'Expiré';
$lang['contracts_view_without_dateend']     = 'Contrats sans date de fin';

# Email Templates
$lang['email_template_contracts_fields_heading'] = 'Contrats';
# Factures General
$lang['invoice_estimate_general_options']        = 'Options générales';
$lang['invoice_table_item_description']          = 'Description';
$lang['invoice_recurring_indicator']             = 'Récurrent';

# Devis
$lang['estimate_convert_to_invoice_successfuly'] = 'Devis converti en facture avec succès';
$lang['estimate_table_item_description']         = 'Description';

# Version 1.0.6
# Factures
# Currencies
$lang['cant_delete_base_currency'] = 'Vous ne pouvez pas supprimer votre devise de base. Vous devez selectionner une nouvelle devise de base avant de la supprimer.';
$lang['invoice_copy']              = 'Dupliquer';
$lang['invoice_copy_success']      = 'Facture dupliquée avec succès';
$lang['invoice_copy_fail']         = 'Impossible de copier la facture';
$lang['invoice_due_after_help']    = 'Définir zéro pour éviter le calcul';

$lang['show_shipping_on_invoice'] = 'Afficher les informations d\'expédition sur la facture';

# Devis
$lang['show_shipping_on_estimate']         = 'Afficher les informations d\'expédition sur le devis';
$lang['is_invoiced_estimate_delete_error'] = 'Ce devis est facturé. Vous ne pouvez pas supprimer ce devis';

# Clients & Factures / Devis
$lang['ship_to']                  = 'Envoyer à';
$lang['customer_profile_details'] = 'Informations Générales';
$lang['billing_shipping']         = 'Facturation & Expédition';
$lang['billing_address']          = 'Adresse de facturation';
$lang['shipping_address']         = 'Adresse d\'expédition';

$lang['billing_street']  = 'Rue';
$lang['billing_city']    = 'Ville';
$lang['billing_state']   = 'Région';
$lang['billing_zip']     = 'Code Postal';
$lang['billing_country'] = 'Pays';

$lang['shipping_street']                    = 'Rue';
$lang['shipping_city']                      = 'Ville';
$lang['shipping_state']                     = 'Région';
$lang['shipping_zip']                       = 'Code Postal';
$lang['shipping_country']                   = 'Pays';
$lang['get_shipping_from_customer_profile'] = 'Obtenez les détails d\'expédition à partir du profil client';

# Client
$lang['customer_file_from']                                    = 'Affichage de %s';
$lang['customer_default_currency']                             = 'Devise par défaut';
$lang['customer_no_attachments_found']                         = 'Aucune pièce jointe trouvée';
$lang['customer_update_address_info_on_invoices']              = 'Mettre à jour les informations de facturation et d\'expédition sur toutes les factures et tous les devis.';
$lang['customer_update_address_info_on_invoices_help']         = 'Si vous sélectionnez cette option les informations de facturation et d\'expédition seront mises à jour sur toutes les factures et tous les devis. Remarque : les factures avec le statut payée ne seront pas affectées.';
$lang['setup_google_api_key_customer_map']                     = 'Paramétrez votre clé google api pour visualiser la carte client';
$lang['customer_attachments_file']                             = 'Fichier';
$lang['client_send_set_password_email']                        = 'Envoyer un email de configuration du mot de passe';
$lang['customer_billing_same_as_profile']                      = 'Identique à l\'adresse principale';
$lang['customer_billing_copy']                                 = 'Copier l\'adresse de facturation';
$lang['customer_map']                                          = 'Map';
$lang['set_password_email_sent_to_client']                     = 'L\'email de création du mot de passe a été envoyé avec succès au client';
$lang['set_password_email_sent_to_client_and_profile_updated'] = 'L\'email de mise à jour du profil et de création du mot de passe a été envoyé avec succès au client';
$lang['customer_attachments']                                  = 'Pièces jointes';
$lang['customer_longitude']                                    = 'Longitude (Google Maps)';
$lang['customer_latitude']                                     = 'Latitude (Google Maps)';

# Authentication
$lang['admin_auth_set_password']          = 'Mot de passe';
$lang['admin_auth_set_password_repeat']   = 'Répétez le mot de passe';
$lang['admin_auth_set_password_heading']  = 'Création du mot de passe';
$lang['password_set_email_subject']       = 'Créer un nouveau mot de passe pour %s';
# General
$lang['apply']                            = 'Appliquer';
$lang['department_calendar_id']           = 'ID calendrier Google';
$lang['kan_ban_string']                   = 'Kan Ban';
$lang['localization_default_language']    = 'Langue par défaut';
$lang['system_default_string']            = 'Système par défaut';
$lang['advanced_options']                 = 'Options avancées';
# Dépenses
$lang['expense_list_invoice']             = 'Facturée';
$lang['expense_list_billed']              = 'Facturée';
$lang['expense_list_unbilled']            = 'Non facturée';
# Prospects
$lang['lead_merge_custom_field']          = 'Fusionner comme champ personnalisé';
$lang['lead_merge_custom_field_existing'] = 'Fusionner avec le champ de base de données existant';
$lang['lead_dont_merge_custom_field']     = 'Ne pas fusionner';
$lang['no_lead_notes_found']              = 'Aucune note prospect trouvée';
$lang['leads_view_list']                  = 'Liste';
$lang['lost_leads']                       = 'Prospects perdus';
$lang['junk_leads']                       = 'Prospects caducs';
$lang['lead_mark_as_lost']                = 'Marquer comme perdu';
$lang['lead_unmark_as_lost']              = 'Marquer comme retrouvé';
$lang['lead_marked_as_lost']              = 'Marqué comme perdu avec succès';
$lang['lead_unmarked_as_lost']            = 'Prospect marqué comme retrouvé avec succès';
$lang['leads_status_color']               = 'Couleur';

$lang['lead_mark_as_junk']     = 'Marquer comme caduc';
$lang['lead_unmark_as_junk']   = 'Marquer comme actif';
$lang['lead_marked_as_junk']   = 'Prospect marqué comme caduc avec succès';
$lang['lead_unmarked_as_junk'] = 'Propspect marqué comme actif avec succès';

$lang['lead_not_found']                                                      = 'Prospect introuvable';
$lang['lead_lost']                                                           = 'Perdu';
$lang['lead_junk']                                                           = 'Caduc';
$lang['leads_not_assigned']                                                  = 'Non affecté';
# Contacts
$lang['contract_not_visible_to_client']                                      = 'Ne pas afficher au client';
$lang['contract_edit_overview']                                              = 'Vue d\'ensemble du contrat';
$lang['contract_attachments']                                                = 'Pièces jointes';
# Tasks
$lang['task_view_make_public']                                               = 'Rendre public';
$lang['task_is_private']                                                     = 'Tâche privée';
$lang['task_finished']                                                       = 'Accomplie';
$lang['task_single_related']                                                 = 'Attribuée à';
$lang['task_unmark_as_complete']                                             = 'Marquer comme non accomplie';
$lang['task_unmarked_as_complete']                                           = 'Tâche marquée comme non accomplie avec succès';
$lang['task_relation']                                                       = 'Liée à';
$lang['task_public']                                                         = 'Public';
$lang['task_public_help']                                                    = 'Si vous definissez cette tâche comme public, elle sera visible par tous les collaborateurs. Autrement elle sera seulement visible par les utilisateurs concernés, followers, auteurs et administrateurs';
# Settings
$lang['settings_general_favicon']                                            = 'Favicon';
$lang['settings_output_client_pdfs_from_admin_area_in_client_language']      = 'Exporter les documents PDF clients à partir du CRM dans la langue selectionnée par le client.';
$lang['settings_output_client_pdfs_from_admin_area_in_client_language_help'] = 'Si vous selectionnez cette option sur OUI et par exemple la langue par défaut du CRM est l\'anglais et que la langue par défaut du client est en français, l\'exportation des documents seront en français.';
$lang['settings_cron_surveys']                                               = 'Sondages';
$lang['settings_default_tax']                                                = 'Taxe par défaut';
$lang['setup_calendar_by_departments']                                       = 'Configurer le calendrier par département';
$lang['settings_calendar']                                                   = 'Calendrier';
$lang['settings_sales_invoice_due_after']                                    = 'Echéance de règlement (en jours)';
$lang['settings_google_api']                                                 = 'Clé API Google';
$lang['settings_gcal_main_calendar_id']                                      = 'ID calendrier Google';
$lang['settings_gcal_main_calendar_id_help']                                 = 'Ceci est le calendrier principal de la société. Tous les événements de ce calendrier seront affichés. Si vous souhaitez configurer un calendrier à un département spécifique vous pouvez l\'ajouter dans votre calendrier Google.';

$lang['show_on_calendar']                  = 'Afficher sur le calendrier :';
$lang['show_invoices_on_calendar']         = 'Factures';
$lang['show_estimates_on_calendar']        = 'Devis';
$lang['show_contracts_on_calendar']        = 'Contrats';
$lang['show_tasks_on_calendar']            = 'Tâches';
$lang['show_customer_reminders_on_calendar'] = 'Customer Reminders';

# Prospects
$lang['copy_custom_fields_convert_to_customer']                      = 'Copier les champs personnalisés au profil client';
$lang['copy_custom_fields_convert_to_customer_help']                 = 'Si l\'un des champs personnalisés suivants n\'existe pas pour le client il sera automatiquement créé avec le même nom autrement seule la valeur sera copiée à partir du profil prospect.';
$lang['lead_profile']                                                = 'Profil';
$lang['lead_is_client']                                              = 'Client';
$lang['leads_kan_ban_notes_title']                                   = 'Notes';
$lang['leads_email_integration_folder_no_encryption']                = 'Aucun cryptage';
$lang['leads_email_integration']                                     = 'Intégration email';
$lang['leads_email_active']                                          = 'Actif';
$lang['leads_email_integration_imap']                                = 'Serveur IMAP';
$lang['leads_email_integration_email']                               = 'Adresse Email (connexion)';
$lang['leads_email_integration_password']                            = 'Mot de passe';
$lang['leads_email_integration_default_source']                      = 'Source par défaut';
$lang['leads_email_integration_check_every']                         = 'Vérifier toutes les (minutes)';
$lang['leads_email_integration_default_assigned']                    = 'Responsable du nouveau prospect';
$lang['leads_email_encryption']                                      = 'Cryptage';
$lang['leads_email_integration_updated']                             = 'Mise à jour intégration email';
$lang['leads_email_integration_default_status']                      = 'Statut par défaut';
$lang['leads_email_integration_folder']                              = 'Dossier';
$lang['leads_email_integration_notify_when_lead_imported']           = 'Notifier lorsque le prospect est importé';
$lang['leads_email_integration_only_check_unseen_emails']            = 'Ne vérifie que les emails non ouverts';
$lang['leads_email_integration_only_check_unseen_emails_help']       = 'Le script configurera automatiquement l\'ouverture de l\'email après vérification. Il est utilisé pour empêcher la vérification systématique et répétitive de tous les emails. Il est recommandé de ne pas décocher cette option si vous avez beaucoup d\'emails et que vous avez configuré beaucoup de transferts pour les mailings prospects';
$lang['leads_email_integration_notify_when_lead_contact_more_times'] = 'Notifier si le prospect envoie l\'email plusieurs fois';
$lang['leads_email_integration_test_connection']                     = 'Tester la connexion IMAP ';
$lang['lead_email_connection_ok']                                    = 'Bonne connexion IMAP';
$lang['lead_email_connection_not_ok']                                = 'Erreur de connexion IMAP';
$lang['lead_email_activity']                                         = 'Email activité';
$lang['leads_email_integration_notify_roles']                        = 'Rôles à notifier';
$lang['leads_email_integration_notify_staff']                        = 'Collaborateurs à notifier';
$lang['lead_public']                                                 = 'Public';
# Knowledge Base

$lang['kb_group_color']                = 'Couleur';
$lang['kb_group_order']                = 'Ordre';
# Utilities - BULK PDF Exporter
$lang['bulk_pdf_exporter']             = 'Exportation PDF';
$lang['bulk_export_pdf_payments']      = 'Règlements';
$lang['bulk_export_pdf_estimates']     = 'Devis';
$lang['bulk_export_pdf_invoices']      = 'Factures';
$lang['bulk_pdf_export_button']        = 'Exporter';
$lang['bulk_pdf_export_select_type']   = 'Sélectionner un type';
$lang['no_data_found_bulk_pdf_export'] = 'Aucune donnée trouvée pour l\'exportation';
$lang['bulk_export_status_all']        = 'Tous';
$lang['bulk_export_status']            = 'Statut';
$lang['bulk_export_zip_payment_modes'] = 'Règlement effectué par:';
$lang['bulk_export_include_tag']       = 'Inclure une étiquette';
$lang['bulk_export_include_tag_help']  = 'Ex. Original ou Copie. L\'étiquette sera incluse dans le PDF. Il est recommandé d\'utiliser un seul mot.';
# Predefined replies
$lang['no_predefined_replies_found']   = 'Auncune réponse prédéfinie trouvée';
## Clients area
$lang['clients_contract_attachments']  = 'Pièces jointes';
# Backup
$lang['backup_type_full']              = 'Sauvegarde intégrale';
$lang['backup_type_db']                = 'Sauvegarde de la base de données';

$lang['auto_backup_options_updated']     = 'Sauvegarde automatique des options mise à jour';
$lang['auto_backup_every']               = 'Créer une sauvegarde tous les X jours';
$lang['auto_backup_enabled']             = 'Activer (besoin de Cron)';
$lang['auto_backup']                     = 'Sauvegarde automatique';
$lang['backup_delete']                   = 'Sauvegarde supprimée';
$lang['create_backup']                   = 'Créer une sauvegarde';
$lang['backup_success']                  = 'Sauvegarde effectuée avec succès';
$lang['utility_backup']                  = 'Sauvegarde';
$lang['utility_create_new_backup_db']    = 'Créer la sauvegarde de la base de données';
$lang['utility_backup_table_backupname'] = 'Sauvegarde';
$lang['utility_backup_table_backupsize'] = 'Taille';
$lang['utility_backup_table_backupdate'] = 'Date';
$lang['utility_db_backup_note']          = 'Remarque: en raison du temps d\'exécution limité et de la mémoire PHP disponible, sauvegarder de très grandes bases de données peut être impossible. Si votre base de données est très grande vous pourriez avoir à la sauvegarder à partir de votre panneau d\'administration serveur SQLle font pour vous si vous n\'avez pas de privilèges de racine.';

# Version 1.0.7
## Clients - portal
$lang['clients_nav_proposals'] = 'Propositions';
$lang['clients_nav_support']   = 'Support';
# General
$lang['more']                  = 'Options';
$lang['add_item']              = 'Ajouter un article';
$lang['goto_admin_area']       = 'Retour au tableau de bord';
$lang['click_here_to_edit']    = 'Cliquez ici pour éditer';
$lang['delete']                = 'Supprimmer %s';
$lang['welcome_top']           = 'Bonjour %s';

# Clients
$lang['customer_permissions']         = 'Permissions';
$lang['customer_permission_invoice']  = 'Factures';
$lang['customer_permission_estimate'] = 'Devis';
$lang['customer_permission_proposal'] = 'Propositions';
$lang['customer_permission_contract'] = 'Contrats';
$lang['customer_permission_support']  = 'Support';


#Tasks
$lang['task_related_to'] = 'Lier à';

# Send file
$lang['custom_file_fail_send']    = 'Echec de l\'envoi du fichier';
$lang['custom_file_success_send'] = 'Fichier envoyé avec succès à %s';
$lang['send_file_subject']        = 'Sujet email';
$lang['send_file_email']          = 'Adresse email ';
$lang['send_file_message']        = 'Message';
$lang['send_file']                = 'Fichier envoyé';
$lang['add_checklist_item']       = 'Ajouter une checklist';
$lang['task_checklist_items']     = 'Checklist';

# Import
$lang['default_pass_clients_import'] = 'Mot de passe par défaut pour tous les clients';
$lang['simulate_import']             = 'Simuler l\'importation';
$lang['import_upload_failed']        = 'Télécharger les échecs';
$lang['import_total_imported']       = 'Total Importé: %s';
$lang['import_leads']                = 'Importer des prospects';
$lang['import_customers']            = 'Importer des clients';
$lang['choose_csv_file']             = 'Importer un fichier CSV';
$lang['import']                      = 'Importer';
$lang['lead_import_status']          = 'Statut';
$lang['lead_import_source']          = 'Source';

# Bulk PDF Export
$lang['bulk_export_pdf_proposals'] = 'Propositions';

# Factures
$lang['delete_invoice'] = 'Supprimer';

# Calendar
$lang['calendar_lead_reminder'] = 'Rappel prospect';

$lang['items']      = 'Articles';
$lang['support']    = 'Support';
$lang['new_ticket'] = 'Nouveau Ticket';

# Reminders
$lang['client_edit_set_reminder_title'] = 'Ajouter un rappel client';
$lang['lead_set_reminder_title']        = 'Ajouter un rappel prospect';
$lang['set_reminder_tooltip']           = 'Cette option vous permet de ne jamais rien oublier sur un client.';
$lang['client_reminders_tab']           = 'Rappels';
$lang['leads_reminders_tab']            = 'Rappels';

# Tickets
$lang['delete_ticket_reply']  = 'Supprimer la réponse';
$lang['ticket_priority_edit'] = 'Editer la priorité';
$lang['ticket_priority_add']  = 'Ajouter une priorité';
$lang['ticket_status_edit']   = 'Editer un statut ticket';
$lang['ticket_service_edit']  = 'Editer un service ticket';
$lang['edit_department']      = 'Editer le département';

# Dépenses
$lang['edit_expense_category']                                    = 'Editer la catégorie de dépenses';
# Settings
$lang['customer_default_country']                                 = 'Pays par défaut';
$lang['settings_sales_require_client_logged_in_to_view_estimate'] = 'Exiger que le client soit connecté pour voir le devis';
$lang['set_reminder']                                             = 'Paramétrer un rappel';
$lang['set_reminder_date']                                        = 'Date de notification';
$lang['reminder_description']                                     = 'Set description';
$lang['reminder_notify_me_by_email']                              = 'Envoyer également un email de notification pour ce rappel';
$lang['reminder_added_successfuly']                               = 'Rappel ajouté avec succès. Vous recevrez une notification.';
$lang['reminder_description']                                     = 'Description';
$lang['reminder_date']                                            = 'Date';
$lang['reminder_staff']                                           = 'Rappel';
$lang['reminder_is_notified']                                     = 'Notifié';
$lang['reminder_is_notified_boolean_no']                          = 'Non';
$lang['reminder_is_notified_boolean_yes']                         = 'Oui';
$lang['reminder_set_to']                                          = 'Paramétrer un rappel pour';
$lang['reminder_deleted']                                         = 'Rappel supprimé';
$lang['reminder_failed_to_delete']                                = 'Echec lors de la supression du rappel';
$lang['show_invoice_estimate_status_on_pdf']                      = 'Afficher le statut des factures et des devis sur le PDF';
$lang['email_piping_default_priority']                            = 'Priorité par défaut sur le ticket pipe';
$lang['show_lead_reminders_on_calendar']                          = 'Rappels prospect';
$lang['tickets_piping']                                           = 'Email Pipe';
$lang['email_piping_only_replies']                                = 'Seules réponses autorisées par email';
$lang['email_piping_only_registered']                             = 'Pipe seulement sur les utilisateurs enregistrés';
$lang['email_piping_enabled']                                     = 'Activer';

# Devis
$lang['view_estimate_as_client']         = 'Affichage client';
$lang['estimate_mark_as']                = 'Marquer comme %s';
$lang['estimate_status_changed_success'] = 'Statut devis modifié';
$lang['estimate_status_changed_fail']    = 'Echec lors de la modification du statut devis';
$lang['estimate_email_link_text']        = 'Voir le devis';

# Propositions
$lang['proposal_to']                            = 'Société / Nom';
$lang['proposal_date']                          = 'Date';
$lang['proposal_address']                       = 'Adresse';
$lang['proposal_phone']                         = 'Téléphone';
$lang['proposal_email']                         = 'Email';
$lang['proposal_date_created']                  = 'Date de création';
$lang['proposal_open_till']                     = 'Date de validité';
$lang['proposal_status_open']                   = 'Ouverte';
$lang['proposal_status_accepted']               = 'Acceptée';
$lang['proposal_status_declined']               = 'Déclinée';
$lang['proposal_status_sent']                   = 'Envoyée';
$lang['proposal_expired']                       = 'Expirée';
$lang['proposal_subject']                       = 'Sujet';
$lang['proposal_total']                         = 'Total';
$lang['proposal_status']                        = 'Statut';
$lang['proposals_list_all']                     = 'Toutes';
$lang['proposals_leads_related']                = 'Prospects liés à';
$lang['proposals_customers_related']            = 'Clients liés à';
$lang['proposal_related']                       = 'Liée à';
$lang['proposal_for_lead']                      = 'Prospect';
$lang['proposal_for_customer']                  = 'Client';
$lang['proposal']                               = 'Proposition';
$lang['proposal_lowercase']                     = 'proposition';
$lang['proposals']                              = 'Propositions';
$lang['proposals_lowercase']                    = 'propositions';
$lang['new_proposal']                           = 'Créer une proposition';
$lang['proposal_currency']                      = 'Devise';
$lang['proposal_allow_comments']                = 'Autoriser les commentaires';
$lang['proposal_allow_comments_help']           = 'Si vous selectionnez cette option les commentaires seront vivibles par le client lors de l\'affichage de la proposition.';
$lang['proposal_edit']                          = 'Editer';
$lang['proposal_pdf']                           = 'PDF';
$lang['proposal_send_to_email']                 = 'Envoyer par email';
$lang['proposal_send_to_email_title']           = 'Envoyé la proposition par email';
$lang['proposal_attach_pdf']                    = 'PDF joint';
$lang['proposal_preview_template']              = 'Aperçu du modèle';
$lang['proposal_view']                          = 'Affichage client';
$lang['proposal_copy']                          = 'Dupliquer';
$lang['proposal_delete']                        = 'Supprimer';
$lang['proposal_to']                            = 'Pour';
$lang['proposal_add_comment']                   = 'Ajouter un commentaire';
$lang['proposal_sent_to_email_success']         = 'Proposition envoyeé par email avec succès';
$lang['proposal_sent_to_email_fail']            = 'Echec lors de l\'envoi de la proposition par email';
$lang['proposal_copy_fail']                     = 'Echec lors de la copie de la proposition';
$lang['proposal_copy_success']                  = 'Proposition copiée avec succès';
$lang['proposal_status_changed_success']        = 'Statut de la proposition modifié avec succès';
$lang['proposal_status_changed_fail']           = 'Echec lors de la modification du statut de la proposition';
$lang['proposal_assigned']                      = 'Attribuer à';
$lang['proposal_comments']                      = 'Commentaires';
$lang['proposal_convert']                       = 'Convertir';
$lang['proposal_convert_estimate']              = 'Devis';
$lang['proposal_convert_invoice']               = 'Facture';
$lang['proposal_convert_to_estimate']           = 'Convertir en devis';
$lang['proposal_convert_to_invoice']            = 'Convertir en facture';
$lang['proposal_convert_to_lead_disabled_help'] = 'Vous devez convertir le prospect en client afin de créer %s';
$lang['proposal_convert_not_related_help']      = 'La proposition doit être liée à un client afin de le convertir en %s';
$lang['proposal_converted_to_estimate_success'] = 'Proposition convertie en devis avec succès';
$lang['proposal_converted_to_invoice_success']  = 'Proposition convertie en facture avec succès';
$lang['proposal_converted_to_estimate_fail']    = 'Echec de la conversion de la proposition en devis';
$lang['proposal_converted_to_invoice_fail']     = 'Echec de la conversion de la proposition en facture';

# Propositions - view proposal template
$lang['proposal_total_info']   = 'Total %s';
$lang['proposal_accept_info']  = 'Acceptée';
$lang['proposal_decline_info'] = 'Declinée';
$lang['proposal_pdf_info']     = 'PDF';

# Clients Portal
$lang['customer_reset_action']            = 'Réinitialiser';
$lang['customer_reset_password_heading']  = 'Réinitialiser votre mot de passe';
$lang['customer_forgot_password_heading'] = 'Mot de passe oublié';
$lang['customer_forgot_password']         = 'Mot de passe oublié ?';
$lang['customer_reset_password']          = 'Mot de passe';
$lang['customer_reset_password_repeat']   = 'Répéter le mot de passe';
$lang['customer_forgot_password_email']   = 'Email';
$lang['customer_forgot_password_submit']  = 'Soummettre';
$lang['customer_ticket_subject']          = 'Sujet';

# Email templates
$lang['email_template_proposals_fields_heading'] = 'Propositions';

# Tasks
$lang['add_task_attachments']                 = 'Joindre un fichier';
$lang['task_view_attachments']                = 'Pièce(s) jointe(s)';
$lang['task_view_description']                = 'Description';
$lang['task_table_is_finished_indicator']     = 'Oui';
$lang['task_table_is_not_finished_indicator'] = 'Non';
$lang['tasks_dt_finished']                    = 'Accomplie';

# Customer Groups
$lang['customer_group_add_heading']  = 'Ajouter une nouvelle catégorie';
$lang['customer_group_edit_heading'] = 'Editer la catégorie client';
$lang['new_customer_group']          = 'Ajouter une catégorie de client';
$lang['customer_group_name']         = 'Type de catégorie';
$lang['customer_groups']             = 'Catégories';
$lang['customer_group']              = 'Catégorie de client';
$lang['customer_group_lowercase']    = 'catégorie de client';

$lang['customer_have_invoices_by']       = 'Factures avec le statut %s';
$lang['customer_have_estimates_by']      = 'Devis avec le statut %s';
$lang['customer_have_contracts_by_type'] = 'Avoir des contrats par type %s';

# Custom fields
$lang['custom_field_show_on_table']              = 'Afficher dans les tableaux';
$lang['custom_field_show_on_client_portal']      = 'Afficher sur l\'espace client';
$lang['custom_field_show_on_client_portal_help'] = 'Si ce champ est coché, il sera également affiché dans les listes';
$lang['custom_field_visibility']                 = 'Affichage';

# Utilities # Menu Builder
$lang['utilities_menu_translate_name_help'] = 'You can add here also translate strings. So if staff/system have language other then the default the menu item names will be outputed in the staff language. Otherwise if the string dont exists in the translate file will be taken the string you enter here.';
$lang['utilities_menu_icon']                = 'Icône';
$lang['active_menu_items']                  = 'Rubriques Actives';
$lang['inactive_menu_items']                = 'Rubriques Inactives';
$lang['utilities_menu_permission']          = 'Permission';
$lang['utilities_menu_url']                 = 'URL';
$lang['utilities_menu_name']                = 'Nom';
$lang['utilities_menu_save']                = 'Enregistrer';

# Knowledge Base
$lang['view_articles_list']     = 'Liste des articles';
$lang['view_articles_list_all'] = 'Liste des articles';
$lang['als_add_article']        = 'Ajouter un article';
$lang['als_all_articles']       = 'Liste des articles';
$lang['als_kb_groups']          = 'Rubriques';

# Configuration du Menu
$lang['menu_builder']            = 'Réglage Navigation';
$lang['main_menu']               = 'Menu Général';
$lang['setup_menu']              = 'Menu Paramètres';
$lang['utilities_menu_url_help'] = '%s is auto appended to the url';

# Spam Filter - Tickets
$lang['spam_filters']                 = 'Filtres spam';
$lang['spam_filter']                  = 'Filtre spam';
$lang['new_spam_filter']              = 'Nouveau filtre spam';
$lang['spam_filter_blocked_senders']  = 'Expéditeurs bloqués';
$lang['spam_filter_blocked_subjects'] = 'Sujets bloqués';
$lang['spam_filter_blocked_phrases']  = 'Phrases bloqués';
$lang['spam_filter_content']          = 'Contenu';
$lang['spamfilter_edit_heading']      = 'Editer le filtre spam';
$lang['spamfilter_add_heading']       = 'Ajouter un filtre spam';
$lang['spamfilter_type']              = 'Type';
$lang['spamfilter_type_subject']      = 'Sujet';
$lang['spamfilter_type_sender']       = 'Expéditeur';
$lang['spamfilter_type_phrase']       = 'Phrase';

# Tickets
$lang['block_sender']               = 'Bloquer l\'expéditeur';
$lang['sender_blocked']             = 'Expéditeur bloqué';
$lang['sender_blocked_successfuly'] = 'Expéditeur bloqué avec succès';
$lang['ticket_date_created']        = 'Date de création';

#KB
$lang['edit_kb_group']             = 'Editer la catégorie';
# Prospects
$lang['edit_source']               = 'Editer la source';
$lang['edit_status']               = 'Editer le statut';
# Contacts
$lang['contract_type_edit']        = 'Editer le type de contrat';
# Reports
$lang['report_by_customer_groups'] = 'Valeur totale par type de catégories clients';
#Utilities
$lang['ticket_pipe_log']           = 'Connexion ticket Pipe';
$lang['ticket_pipe_name']          = 'A partir du nom';
$lang['ticket_pipe_email_to']      = 'au nom';
$lang['ticket_pipe_email']         = 'A partir de l\'email';
$lang['ticket_pipe_subject']       = 'Sujet';
$lang['ticket_pipe_message']       = 'Message';
$lang['ticket_pipe_date']          = 'Date';
$lang['ticket_pipe_status']        = 'Statut';

# Home
$lang['home_invoice_paid']          = 'Factures payées';
$lang['home_invoice_partialy_paid'] = 'Factures partiellement payées';
$lang['home_estimate_declined']     = 'Devis annulés';
$lang['home_estimate_accepted']     = 'Devis acceptés';
$lang['home_estimate_sent']         = 'Devis envoyés';
$lang['home_latest_activity']       = 'Dernières activités';
$lang['home_my_tasks']              = 'Mes Tâches';
$lang['home_latest_activity']       = 'Dernières Activités';
$lang['home_my_todo_items']         = 'Liste todo';
$lang['home_widget_view_all']       = 'Tout Voir';
$lang['home_stats_full_report']     = 'Rapport Complet';

# Validation - Customer Portal

$lang['form_validation_required']    = 'Le champ {field} est requis.';
$lang['form_validation_valid_email'] = 'Le champ {field} doit contenir une adresse email valide.';
$lang['form_validation_matches']     = 'Le champ {field} field does not match the {param} field.';
$lang['form_validation_is_unique']   = 'Le champ {field} doit contenir une valeur unique.';

# Version 1.0.8
# Notifications & Prospects/Devis/Factures Activity Log
$lang['not_event'] = 'Event start today - %s ...';
$lang['not_event_public'] = 'Public event start today - %s ...';
$lang['not_contract_expiry_reminder'] = 'Rappel de l\'expiration du contrat - %s ...';
$lang['not_recurring_expense_cron_activity_heading'] = 'Dépenses récurrentes du Cron Job Activité';
$lang['not_recurring_invoices_cron_activity_heading'] = 'Factures récurrentes du Cron Job Activité';
$lang['not_recurring_total_renewed'] = 'Total renouvelé: %s';
$lang['not_recurring_expenses_action_taken_from'] = 'Mesure prise en fonction des dépenses récurrentes';
$lang['not_invoice_created'] = 'Facture créée:';
$lang['not_invoice_renewed'] = 'Facture renouvelée:';
$lang['not_expense_renewed'] = 'Dépense renouvelée:';
$lang['not_invoice_sent_to_customer'] = 'Facture envoyée au client: %s';
$lang['not_invoice_sent_yes'] = 'Oui';
$lang['not_invoice_sent_not'] = 'Non';
$lang['not_action_taken_from_recurring_invoice'] = 'Mesure prise en fonction des factures récurrentes:';
$lang['not_new_reminder_for'] = 'Nouveau rappel pour %s';
$lang['not_received_one_or_more_messages_lead'] = 'message email reçu de votre prospect';
$lang['not_received_lead_imported_email_integration'] = 'Prospect importé de l\'intégration email';
$lang['not_lead_imported_attachment'] = 'Pièces jointes importées de l\email';
$lang['not_estimate_status_change'] = 'Pièces jointes importées de l\email';
$lang['not_estimate_status_updated'] = 'Mise à jour statut devis: de: %s à %s';
$lang['not_goal_message_success'] = 'Félicitation! Vous avez réussi votre nouvel objectif. <br />Type d\'objectif : %s
<br />Goal Achievement: %s
<br />Total Achivement: %s
<br />Date de début : %s
<br />Date de fin : %s';
$lang['not_assigned_lead_to_you'] = '%s vous a assigné le prospect %s';
$lang['not_lead_activity_assigned_to'] = '%s assigné à %s';
$lang['not_lead_activity_attachment_deleted'] = 'Supprimer les pièces jointes';
$lang['not_lead_activity_status_updated'] = '%s a mis à jour le statut prospect de %s à %s';
$lang['not_lead_activity_contacted'] = '%s à contacté ce prospect sur %s';
$lang['not_lead_activity_created'] = '%s a créé un prospect';
$lang['not_lead_activity_marked_lost'] = 'Marquer comme perdu';
$lang['not_lead_activity_unmarked_lost'] = 'Marquer comme retrouvé';
$lang['not_lead_activity_marked_junk'] = 'Marquer comme caduc';
$lang['not_lead_activity_unmarked_junk'] = 'Marquer comme actif';
$lang['not_lead_activity_added_attachment'] = 'Ajouter une pièce jointe';
$lang['not_lead_activity_converted_email'] = 'L\'email du prospect a été modifié. Le premier email du prospect était: %s et  a été ajouté comme client avec l\'email %s';
$lang['not_lead_activity_converted'] = '%s a converti ce prospect en client';
$lang['not_liked_your_post'] = '%s a aimé votre publication %s ...';
$lang['not_commented_your_post'] = '%s a commenté votre publication %s ...';
$lang['not_liked_your_comment'] = '%s a aimé votre commentaire %s ...';
$lang['not_proposal_assigned_to_you'] = 'Proposition assignée à vous - %s ...';
$lang['not_proposal_comment_from_client'] = 'Nouveau commentaire du client sur la proposition %s ...';
$lang['not_proposal_proposal_accepted'] = 'Proposition acceptée';
$lang['not_proposal_proposal_declined'] = 'Proposition déclinée';
$lang['not_task_added_you_as_follower'] = 'vous a ajouté comme follower sur la tâche %s ...';
$lang['not_task_added_someone_as_follower'] = 'a ajouté %s comme follower sur la tâche %s ...';
$lang['not_task_added_himself_as_follower'] = 's\'est ajouté comme follower sur la tâche %s ...';
$lang['not_task_assigned_to_you'] = 'vous a assigné une tâche %s ...';
$lang['not_task_assigned_someone'] = 'a assigné %s à la tâche %s ...';
$lang['not_task_will_do_user'] = 'executera la tâche %s ...';
$lang['not_task_new_attachment'] = 'Nouvelle pièce jointe ajoutée';
$lang['not_task_marked_as_complete'] = 'a marqué la tâche comme accomplie %s';
$lang['not_task_unmarked_as_complete'] = 'marquer la tâche comme non accomplie %s';
$lang['not_ticket_assigned_to_you'] = 'un ticket vous a été assigné - %s ...';
$lang['not_ticket_reassigned_to_you'] = 'un ticket vous a été réassigné - %s ...';
$lang['not_estimate_customer_accepted'] = 'Félicitation! Le client a accepté le devis numéro %s';
$lang['not_estimate_customer_declined'] = 'Le client a refusé le devis numéro %s';
$lang['estimate_activity_converted'] = 'a converti ce devis en facture.<br /> %s';
$lang['estimate_activity_created'] = 'a créer le devis';
$lang['invoice_estimate_activity_removed_item'] = 'article supprimé <b>%s</b>';
$lang['estimate_activity_number_changed'] = 'Numéro de devis modifié de %s à %s';
$lang['invoice_activity_number_changed'] = 'Numéro de facture modifié de %s à %s';
$lang['invoice_estimate_activity_updated_item_short_description'] = 'description courte de l\'article mise à jour de %s à %s';
$lang['invoice_estimate_activity_updated_item_long_description'] = 'description longue de l\'article mise à jour de <b>%s</b> à <b>%s</b>';
$lang['invoice_estimate_activity_updated_item_rate'] = 'updated item rate from %s to %s';
$lang['invoice_estimate_activity_updated_qty_item'] = 'updated quantity on item <b>%s</b> from %s to %s';
$lang['invoice_estimate_activity_added_item'] = 'a ajouté un nouvel article <b>%s</b>';
$lang['invoice_estimate_activity_sent_to_client'] = 'sent estimate to client';
$lang['estimate_activity_client_accepted_and_converted'] = 'Le client a accepté le devis. Le devis a été converti en facture numéro %s';
$lang['estimate_activity_client_accepted'] = 'Le client a accepté ce devis';
$lang['estimate_activity_client_declined'] = 'Le client a refusé ce devis';
$lang['estimate_activity_marked'] = 'devis marqué comme %s';
$lang['invoice_activity_status_updated'] = 'Statut de la facture mis à jour de %s à %s';
$lang['invoice_activity_created'] = 'a créé la facture';
$lang['invoice_activity_from_expense'] = 'converti en facture à partir de la dépense';
$lang['invoice_activity_recuring_created'] = '[Réccurent] Facture créée par CRON';
$lang['invoice_activity_recuring_from_expense_created'] = '[Facture à partir de la dépense] Facture créée par CRON';
$lang['invoice_activity_sent_to_client_cron'] = 'Facture envoyée au client par CRON';
$lang['invoice_activity_sent_to_client'] = 'facture envoyée au client';
$lang['invoice_activity_marked_as_sent'] = 'facture marquée comme envoyée';
$lang['invoice_activity_payment_deleted'] = 'Règlement supprimé pour cette facture. Règlement #%s, montant total %s';
$lang['invoice_activity_payment_made_by_client'] = 'Client made payment for the invoice from total <b>%s</b> - %s';
$lang['invoice_activity_payment_made_by_staff'] = 'règlement enregistré à partir du total <b>%s</b> - %s';
$lang['invoice_activity_added_attachment'] = 'Pièce jointe ajoutée';
$lang['invoice_total_paid'] = 'Total réglé';
$lang['invoice_amount_due'] = 'Solde à régler';

# Navigation
$lang['top_search_placeholder'] = 'Rechercher...';

# Staff
$lang['staff_profile_inactive_account'] = 'Ce compte collaborateur est inactif';

# Devis
$lang['copy_estimate'] = 'Copier le devis';
$lang['estimate_copied_successfuly'] = 'Devis copié avec succès';
$lang['estimate_copied_fail'] = 'Echec lors de la copie du devis';

# Tasks
$lang['tasks_view_assigned_to_user'] = 'Tâches qui me sont assignées';
$lang['tasks_view_follower_by_user'] = 'Tâches dont je suis le follower';
$lang['no_tasks_found'] = 'Aucune tâche trouvée';

# Prospects
$lang['leads_dt_datecreated'] = 'Créé le';
$lang['leads_sort_by'] = 'Trier par';
$lang['leads_sort_by_datecreated'] = 'Date de création';
$lang['leads_sort_by_kanban_order'] = 'Ordre Kan Ban';

# Propositions
$lang['proposal_items_name'] = 'Désignation';
$lang['proposal_items_description'] = 'Description';
$lang['proposal_items_qty'] = 'Qté.';
$lang['proposal_items_rate'] = 'Prix unitaire';
$lang['proposal_items_tax'] = 'Taxe';
$lang['proposal_items_amount'] = 'Montant';

# Authentication
$lang['check_email_for_reseting_password'] = 'Vérifiez votre email pour plus d\'instructions concernant la réinitialisation de votre mot de passe';
$lang['inactive_account'] = 'Compte inactif';
$lang['error_setting_new_password_key'] = 'Erreur de réglage pour le nouveau mot de passe';
$lang['password_reset_message'] = 'Votre mot de passe a été réinitialisé. Veuillez vous connecter à nouveau!';
$lang['password_reset_message_fail'] = 'Erreur de réinitialisation de votre mot de passe. Veuillez essayer à nouveau.';
$lang['password_reset_key_expired'] = 'Mopt de passe expiré ou identifiant invalide';
$lang['admin_auth_reset_pass_repeat'] = 'Répéter le mot de passe';
$lang['auth_reset_pass_email_not_found'] = 'Email introuvable';
$lang['auth_reset_password_submit'] = 'Réinitialiser le mot de passe';

# Settings
$lang['settings_amount_to_words'] = 'Montant en lettres';
$lang['settings_amount_to_words_desc'] = 'Afficher le montant total en lettres sur les factures et les devis';
$lang['settings_amount_to_words_enabled'] = 'Activer';
$lang['settings_total_to_words_lowercase'] = 'Afficher les lettres en minuscules';
$lang['settings_show_tax_per_item'] = 'Afficher la taxe par ligne d\'article (Factures/Devis)';

# Reports
$lang['report_sales_months_three_months'] = '3 derniers mois';
$lang['report_invoice_number'] = 'Numéro';
$lang['report_invoice_customer'] = 'Client';
$lang['report_invoice_date'] = 'Date de facture';
$lang['report_invoice_duedate'] = 'Date d\'échéance';
$lang['report_invoice_amount'] = 'Montant HT';
$lang['report_invoice_amount_with_tax'] = 'Montant TTC';
$lang['report_invoice_amount_open'] = 'Solde à payer';
$lang['report_invoice_status'] = 'Statut';
$lang['report_invoice_total_amount_with_tax'] = 'Chiffre d\'affaires TTC';
$lang['report_invoice_total_amount_without_tax'] = 'Chiffre d\'affaires HT';
$lang['report_invoice_total_taxes'] = 'Taxes';

#Version 1.0.9

# Home stats
$lang['home_stats_by_project_status'] = 'Statistique par statut de projet';
$lang['home_invoice_overview'] = 'Aperçu des factures';
$lang['home_estimate_overview'] = 'Aperçu des devis';
$lang['home_proposal_overview'] = 'Aperçu des propositions';
$lang['home_lead_overview'] = 'Aperçu des prospects';
$lang['home_my_projects'] = 'Mes Projets';
$lang['home_announcements'] = 'Annonces';

# Settings
$lang['settings_leads_kanban_limit'] = 'Nombre maximum de lignes par statut pout les prospects Kan Ban';
$lang['settings_group_misc'] = 'Divers';
$lang['show_projects_on_calendar'] = 'Afficher les projets sur le calendrier';
$lang['settings_media_max_file_size_upload'] = 'Taille maximale des fichiers envoyés dans la rubrique Media (MB)';
$lang['settings_client_staff_add_edit_delete_task_comments_first_hour'] = 'Permettre au client/collaborateur d\'ajouter/éditer un commentaire sur une tâche seulement durant la première heure (hors administrateurs)';

# Email templates
$lang['email_template_only_domain_email'] = 'Email principal';

# Announcements
$lang['dismiss_announcement'] = 'Annonce rejetée';
$lang['dismiss_announcement'] = 'Annonce rejetée';
$lang['announcement_from'] = 'De:';
$lang['announcement_date'] = 'Date postée: %s';
$lang['announcement_not_found'] = 'Annonce non trouvée';
$lang['announcements_recents'] = 'Annonces récentes';

# General
$lang['zip_invoices'] = 'Factures Zip';
$lang['zip_estimates'] = 'Devis Zip';
$lang['zip_payments'] = 'Règlements Zip';
$lang['setup_help'] = 'Documentation';
$lang['clients_list_company'] = 'Société';
$lang['dt_button_export'] = 'Exporter';

$lang['dt_entries'] = 'enregistrement';
$lang['invoice_total_paid'] = 'Total payé';
$lang['invoice_amount_due'] = 'Solde à payer';
$lang['report_invoice_discount'] = 'Remises';

# Calendar
$lang['calendar_project'] = 'Projet';

# Leads
$lang['leads_import_assignee'] = 'Attribution';
$lang['customer_from_lead'] = 'Cleint de %s';
$lang['lead_kan_ban_attachments'] = 'Pièces jointes %s';
$lang['leads_sort_by_lastcontact'] = 'Dernier contact';

# Tasks
$lang['task_comment_added'] = 'Commentaire ajouté avec succès';
$lang['task_duedate'] = 'Date d\'échéance';
$lang['task_view_comments'] = 'Commentaires';
$lang['task_comment_updated'] = 'Commentaire mis à jour';
$lang['task_visible_to_client'] = 'Visible par le client';
$lang['task_hourly_rate'] = 'Taux horaire';
$lang['hours'] = 'Heures';
$lang['seconds'] = 'Secondes';
$lang['minutes'] = 'Minutes';
$lang['task_start_timer'] = 'Démarrer le compteur';
$lang['task_stop_timer'] = 'Arrêter le compteur';
$lang['task_billable_help'] = 'Si vous sélectionnez l\'option facturable, la tâche sera affichée comme une ligne produit lors de la création de la facture ';
$lang['task_billable'] = 'Facturable';
$lang['task_billable_yes'] = 'Facturable';
$lang['task_billable_no'] = 'Non Facturable';
$lang['task_billed'] = 'Facturée';
$lang['task_billed_yes'] = 'Facturée';
$lang['task_billed_no'] = 'Non facturée';
$lang['task_user_logged_time'] = 'l\'heure de votre connexion:';
$lang['task_total_logged_time'] = 'Temps total de connexion:';
$lang['task_is_billed'] = 'Cette tâche est comptabilisée sur la facture numéro %s';
$lang['task_statistics'] = 'Statistiques';
$lang['task_milestone'] = 'Etape';

# Tickets
$lang['ticket_message_updated_successfuly'] = 'Message mis à jour avec succès';

# Invoices
$lang['invoice_task_item_project_tasks_not_included'] = 'Les tâches des projets ne sont pas incluses dans cette liste.';
$lang['show_quantity_as'] = 'Type d\'affichage des quantités:';
$lang['quantity_as_qty'] = 'Qté.';
$lang['quantity_as_hours'] = 'Heures';
$lang['invoice_table_hours_heading'] = 'Heures';
$lang['bill_tasks'] = 'Facturer une tâche';
$lang['invoice_estimate_sent_to_email'] = 'Email';

# Estimates
$lang['estimate_table_hours_heading'] = 'Heures';

# General
$lang['is_customer_indicator'] = 'Client';
$lang['print']            = 'Imprimer';
$lang['customer_permission_projects']            = 'Projets';
$lang['no_timers_found']            = 'Aucun compteur démarré trouvé';
$lang['timers_started_confirm_logout']            = 'Des compteurs de tâches démarrés ont été trouvés!<br /><br /Etes-vous sûr de vouloir vous déconnecter sans avoir arrêté les compteurs?';
$lang['confirm_logout']            = 'Se déconnecter';
$lang['timer_top_started']            = 'Démarré à %s';

# Projects
$lang['cant_change_billing_type_billed_tasks_found'] = 'Vous ne pouvez pas changer le type de facturation. Des tâches facturées ont déjà été trouvées pour ce projet.';
$lang['project_customer_permission_warning'] = 'Le système indique que le client ne dispose pas d\'autorisation pour les projets. Le client ne pourra pas voir le projet. Veuillez ajouter une permission dans le profil client onglet Autorisations.';
$lang['project_invoice_timesheet_start_time'] = 'Heure de début: %s';
$lang['project_invoice_timesheet_end_time'] = 'Heure de fin: %s';
$lang['project_invoice_timesheet_total_logged_time'] = 'temps de connexion: %s';
$lang['project_view_as_client'] = 'Voir le projet comme un client';
$lang['project_mark_all_tasks_as_completed'] = 'Marquer toutes les tâches comme accomplies et arrêter tous les compteurs (aucune notification envoyée aux membres du projet)';
$lang['project_not_started_status_tasks_timers_found'] = 'Compteur de tâche trouvé sur un projet dans le statut n\'est pas commencé. Il est recommandé de modifier le statut actuel du projet pour le statut: en cours';
$lang['project_status'] = 'Statut';
$lang['project_status_1'] = 'Non commencé';
$lang['project_status_2'] = 'En cours';
$lang['project_status_3'] = 'En attente';
$lang['project_status_4'] = 'Fini';

$lang['project_file_uploaded_by_customer'] = 'Client';
$lang['project_file_dateadded'] = 'Date de téléchargement';
$lang['project_file_filename'] = 'Nom de fichier';
$lang['project_file__filetype'] = 'Type de fichier';
$lang['project_file_visible_to_customer'] = 'Visible par la clientèle';
$lang['project_file_uploaded_by'] = 'Téléchargé par';
$lang['edit_project'] = 'Editer le projet';
$lang['copy_project'] = 'Dupliquer le projet';
$lang['delete_project'] = 'Supprimer le projet';
$lang['project_task_assigned_to_user'] = 'Tâche assignée à vous';
$lang['seconds'] = 'Secondes';
$lang['hours'] = 'Heures';
$lang['minutes'] = 'Minutes';
$lang['project']                 = 'Projet';
$lang['project_lowercase']       = 'projet';
$lang['projects']                = 'Projets';
$lang['projects_lowercase']      = 'projets';
$lang['project_settings']      = 'Paramètres du projet';
$lang['project_invoiced_successfuly']             = 'Projet facturé avec succès';
$lang['new_project']             = 'Créer un projet';
$lang['project_files']            = 'Fichiers';
$lang['project_activity']            = 'Activité';
$lang['project_name']            = 'Nom du projet';
$lang['project_description']            = 'Description du projet';
$lang['project_customer']            = 'Client';
$lang['project_start_date']            = 'Date de début';
$lang['project_datecreated']            = 'Date de création';
$lang['project_deadline']            = 'Date de fin';
$lang['project_billing_type']            = 'Type de facturation';
$lang['project_billing_type_fixed_cost']            = 'Coût fixe';
$lang['project_billing_type_project_hours']            = 'Heures de projet';
$lang['project_billing_type_project_task_hours']            = 'Heures de tâches';
$lang['project_billing_type_project_task_hours_hourly_rate']            = 'Basé sur le taux horaire de la tâche';
$lang['project_rate_per_hour']            = 'Tarif horaire';
$lang['project_total_cost']            = 'Coût total';
$lang['project_members']            = 'Membres du projet';
$lang['project_member_removed']     = 'Membre du projet retiré avec succès';
$lang['project_overview']           = 'Synthèse du projet';
$lang['project_estimates']          = 'Devis';
$lang['project_gant']            = 'Diagramme de Gantt';
$lang['project_milestones']            = 'Etapes';
$lang['project_milestone_order']            = 'Ordre';
$lang['project_milestone_duedate_passed']            = 'Date d\'échéance passée';
$lang['record_timesheet']            = 'Ajouter une feuille de temps';
$lang['new_milestone']            = 'Ajouter une étape';
$lang['edit_milestone']            = 'Editer l\'étape';
$lang['milestone_name']            = 'Nom';
$lang['milestone_due_date']            = 'Date d\'échéance';
$lang['project_milestone']            = 'Etape';
$lang['project_notes']            = 'Notes';
$lang['project_timesheets']            = 'Feuilles de temps';
$lang['project_timesheet']            = 'Feuille de temps';
$lang['milestone_total_logged_time']            = 'Temps connecté';
$lang['project_overview_total_logged_hours']            = 'Total des heures connectées';
$lang['milestones_uncategorized']            = 'Non classé';
$lang['milestone_no_tasks_found']            = 'Aucune tâche trouvée';
$lang['copy_project_discussions_not_included']            = 'Pièces-jointes et commentaires non inclus';
$lang['project_copied_successfuly']            = 'Les données du projet sont copiées avec succès';
$lang['failed_to_copy_project']            = 'La copie du projet a échoué';
$lang['copy_project_task_include_check_list_items']            = 'Copier les articles de la checklist';
$lang['copy_project_task_include_assignees']            = 'Copier les mêmes attributions';
$lang['copy_project_task_include_followers']            = 'Copier les mêmes followers';

$lang['project_days_left']            = 'Jours restants';
$lang['project_open_tasks']            = 'Tâches ouvertes';
$lang['timesheet_stop_timer']            = 'Arrêter le compteur';
$lang['failed_to_add_project_timesheet_end_time_smaller']            = 'Echec lors de l\'ajout de la timesheet. L\'heure de fin est nférieure à l\'heure de début';
$lang['project_timesheet_user']            = 'Collaborateur';
$lang['project_timesheet_start_time']            = 'Heure de début';
$lang['project_timesheet_end_time']            = 'Heure de fin';
$lang['project_timesheet_time_spend']            = 'Temps passé';
$lang['project_timesheet_task']            = 'Tâche';
$lang['project_invoices']                = 'Factures';
$lang['total_logged_hours_by_staff']            = 'Temps total de connexion';
$lang['invoice_project']            = 'Facturer le projet';
$lang['invoice_project_info']            = 'Info projet de facturation';
$lang['invoice_project_data_single_line']            = 'Single line';
$lang['invoice_project_data_task_per_item']            = 'Task per item';
$lang['invoice_project_data_timesheets_individualy']            = 'All timesheets individualy';
$lang['invoice_project_item_name_data']            = 'Nom de l\'article';
$lang['invoice_project_description_data']            = 'Description';
$lang['invoice_project_projectname_taskname']            = 'Nom du projet + nom de la tâche';
$lang['invoice_project_all_tasks_total_logged_time']            = 'Toutes les tâches + temps total de connexion par tâche';
$lang['invoice_project_project_name_data']            = 'Project name';
$lang['invoice_project_timesheet_indivudualy_data']            = 'Timesheet heure de début + heure de fin + temps total de connexion';
$lang['invoice_project_total_logged_time_data']            = 'Temps total de connexion';

$lang['project_allow_client_to'] = 'Autoriser les clients à %s';
$lang['project_setting_view_task_attachments'] = 'voir les pièces-jointes de la tâche';
$lang['project_setting_view_task_checklist_items'] = 'voir les points de la checklist';
$lang['project_setting_upload_files'] = 'télécharger des fichiers';
$lang['project_setting_view_task_comments'] = 'voir les commentaires de la tâche';
$lang['project_setting_upload_on_tasks'] = 'télécharger des pièces jointes sur les tâches';
$lang['project_setting_view_task_total_logged_time'] = 'voir le temps total de connexion sur la tâche';
$lang['project_setting_open_discussions'] = 'ouvrir des discussions';
$lang['project_setting_comment_on_tasks'] = 'commenter les tâches du projet';
$lang['project_setting_view_tasks'] = 'voir les tâches';
$lang['project_setting_view_milestones'] = 'voir les étapes';
$lang['project_setting_view_gantt'] = 'voir le diagramme de Gantt';
$lang['project_setting_view_timesheets'] = 'voir les feuilles de temps';
$lang['project_setting_view_activity_log'] = 'voir le journal d\'activité';
$lang['project_setting_view_team_members'] = 'voir les membres de l\'équipe';

$lang['project_discussion_visible_to_customer_yes']                 = 'Visible';
$lang['project_discussion_visible_to_customer_no']                 = 'Invisible';

$lang['project_discussion_posted_on']                 = 'Publié le %s';
$lang['project_discussion_posted_by']                 = 'Publié par %s';
$lang['project_discussion_failed_to_delete']                 = 'Impossible de supprimer la discussion';
$lang['project_discussion_deleted']                 = 'Discussion supprimée avec succès';
$lang['project_discussion_no_activity']                 = 'Aucune activité';
$lang['project_discussion']                 = 'Discussion';
$lang['project_discussions']                 = 'Discussions';
$lang['edit_discussion'] = 'Créer une discussion';
$lang['new_project_discussion'] = 'Créer une discussion';
$lang['project_discussion_subject'] = 'Sujet';
$lang['project_discussion_description'] = 'Description';
$lang['project_discussion_show_to_customer'] = 'Visible par la clientèle';
$lang['project_discussion_total_comments'] = 'Total Commentaires';
$lang['project_discussion_last_activity'] = 'Dernière Activité';
$lang['discussion_add_comment'] = 'Ajouter un commentaire';
$lang['discussion_newest'] = 'Les plus récentes';
$lang['discussion_oldest'] = 'Les plus anciennes';
$lang['discussion_attachments'] = 'Pièces jointes';
$lang['discussion_send'] = 'Envoyer';
$lang['discussion_reply'] = 'Répondre';
$lang['discussion_edit'] = 'Editer';
$lang['discussion_edited'] = 'Modifié';
$lang['discussion_you'] = 'Vous';
$lang['discussion_save'] = 'Enregistrer';
$lang['discussion_delete'] = 'Supprimer';
$lang['discussion_view_all_replies'] = 'Voir toutes les réponses';
$lang['discussion_hide_replies'] = 'Masquer les réponses';
$lang['discussion_no_comments'] = 'Aucun commentaire';
$lang['discussion_no_attachments'] = 'Aucune pièce jointe';
$lang['discussion_attachments_drop'] = 'Glisser-déposer pour télécharger le fichier';
$lang['project_note'] = 'Note';
$lang['project_note_private'] = 'Notes privées';
$lang['project_save_note'] = 'Enregistrer la note';

# Project Activity
$lang['project_activity_created'] = 'a créé un projet';
$lang['project_activity_updated'] = 'Projet mis à jour';
$lang['project_activity_removed_team_member'] = 'Retirez le membre de l\'équipe';
$lang['project_activity_added_team_member'] = 'Nouveau membre de l\'équipe ajouté';
$lang['project_activity_marked_all_tasks_as_complete'] = 'Marquer toutes les tâches comme accomplies';
$lang['project_activity_recorded_timesheet'] = 'Timesheet enregistrée';
$lang['project_activity_task_name'] = 'Tâche:';
$lang['project_activity_deleted_discussion'] = 'Discussion supprimée';
$lang['project_activity_created_discussion'] = 'Discussion créée';
$lang['project_activity_updated_discussion'] = 'Discussion mise à jour';
$lang['project_activity_commented_on_discussion'] = 'Commenté sur la discussion';
$lang['project_activity_deleted_discussion_comment'] = 'Commentaire de la discussion supprimé';
$lang['project_activity_deleted_milestone'] = 'Etape supprimée';
$lang['project_activity_updated_milestone'] = 'Etape mise à jour';
$lang['project_activity_created_milestone'] = 'Nouvelle étape créée';
$lang['project_activity_invoiced_project'] = 'Projet facturé';
$lang['project_activity_task_marked_complete'] = 'Tâche marquée comme accomplie';
$lang['project_activity_task_unmarked_complete'] = 'Tâche non marquée comme accomplie';
$lang['project_activity_task_deleted'] = 'Tâche supprimée';
$lang['project_activity_new_task_comment'] = 'Commenté sur la tâche';
$lang['project_activity_new_task_attachment'] = 'Pièce jointe téléchargée sur la tâche';
$lang['project_activity_new_task_assignee'] = 'Nouvelle attribution de tâche ajoutée';
$lang['project_activity_task_assignee_removed'] = 'Attribution de tâche supprimée';
$lang['project_activity_task_timesheet_deleted'] = 'Timesheet supprimé';
$lang['project_activity_uploaded_file'] = 'Fichier projet téléchargé';
$lang['project_activity_status_updated'] = 'Statut projet mis à jour';
$lang['project_activity_visible_to_customer'] = 'Affiché au client';
$lang['project_activity_project_file_removed'] = 'Fichier projet supprimé';

# Notifications - DEPRECED - THESE notifications are depreced and will be removed in further released dont translate them
$lang['not_customer_uploaded_project_file'] = 'Nouveau fichier téléchargé';
$lang['not_customer_created_new_project_discussion'] = 'Nouvelle discussion projet créé';
$lang['not_customer_commented_on_project_discussion'] = 'Nouveau commentaire sur la discussion projet';

# Customers area
$lang['clients_my_estimates'] = 'Mes devis';
$lang['client_no_reply'] = 'Pas de réponse';
$lang['clients_nav_projects'] = 'Projets';
$lang['clients_my_projects'] = 'Mes Projets';
$lang['client_profile_image'] = 'Image du profil';

/////
$lang['sales_report_cancelled_invoices_not_included'] = 'Les factures annulées sont exclues du rapport';
$lang['invoices_merge_cancel_merged_invoices'] = ' Marquer les factures fusionnées comme annulées au lieu de les supprimer';
$lang['invoice_marked_as_cancelled_successfuly'] = 'Facture marqué comme annulée';
$lang['invoice_unmarked_as_cancelled'] = 'Facture non marquée commme annulée';

$lang['tasks_reminder_notification_before'] = 'Rappel deadline de la tâche avant (Jours)';
$lang['not_task_deadline_reminder'] = 'Rappel deadline de la tâche';
$lang['dt_length_menu_all'] = 'Tous';
$lang['task_not_finished'] = 'Non achevée';
$lang['task_billed_cant_start_timer'] = 'Tâche facturée. Le compteur ne peut pas être démarré';
$lang['invoice_task_billable_timers_found'] = 'Compteur démarré trouvé';
$lang['project_timesheet_not_updated'] = 'Timesheet non affecté';
$lang['project_invoice_task_no_timers_found'] = 'Aucun compteur pour cette tâche';
$lang['invoice_project_tasks_not_started'] = 'Pas encore commencé | Date de début: %s';
$lang['invoice_project_see_billed_tasks'] = 'Voir les tâches qui seront comptabilisées sur la facture';
$lang['invoice_project_all_billable_tasks_marked_as_finished'] = 'Toutes les tâches facturées seront marquées comme finies';
$lang['invoice_project_nothing_to_bill'] = 'Aucune tâche à facturer. Vous pouvez ajouter ce que vous voulez dans les points de facture.';
$lang['invoice_project_start_date_tasks_not_passed'] = 'Les Tâches qui débuteront prochainement ne peuvent pas être facturées';
$lang['invoice_project_stop_all_timers'] = 'Arrêter tous les compteurs';
$lang['invoice_project_stop_billabe_timers_only'] = 'Arrêter seulement les compteurs facturables';
$lang['project_tasks_total_timers_stopped'] = 'Stopped total %s timers';
$lang['project_invoice_timers_started'] = 'Compteurs de tâche en cours d\'exécution trouvés sur les tâches facturables, vous ne pouvez pas créer de facture. Veuillez arrêter les compteurs de tâche.';
$lang['task_start_timer_only_assignee'] = 'Vous devez être assigné à cette tâche pour démarrer le compteur!';
$lang['task_comments'] = 'Commentaires';
$lang['invoice_total_tax'] = 'Total Taxe';
$lang['estimates_total_tax'] = 'Total Taxe';
$lang['report_invoice_total_tax'] = 'Total Taxe';
$lang['home_tickets'] = 'Tickets';
$lang['home_project_activity'] = 'Dernières activités projets';
$lang['home_project_activity_not_found'] = 'Aucune activité de projets trouvée';
$lang['view_tracking'] = 'Suivi des vues';
$lang['view_date'] = 'Date';
$lang['view_ip'] = 'Adresse IP ';
$lang['article_total_views'] = 'Vues totales';
$lang['leads_source'] = 'Source';
$lang['invoices_available_for_merging'] = 'Factures disponibles pour la fusion';
$lang['invoices_merge_discount'] = 'Vous devrez appliquer une réduction manuellement au total % s  sur cette facture';
$lang['invoice_merge_number_warning'] = 'La fusion des factures va créer un écart dans les numéros de facture. Vous avez également la possibilité de régler manuellement les numéros de facture si vous voulez éviter les écarts.';
$lang['invoice_mark_as'] = 'Marquer comme %s';
$lang['invoice_unmark_as'] = 'Unmark as %s';
$lang['invoice_status_cancelled'] = 'Supprimé';
$lang['tasks_reminder_notification_before_help'] = 'Notifier les attributions de tâches sur la deadline X jours avant. La notification/email est uniquement envoyée aux collaborateurs assignés.';

# Version 1.1.0
$lang['project_invoice_select_all_tasks'] = 'Sélectionnez toutes les tâches';
$lang['lead_company'] = 'Société';

# Version 1.1.1
$lang['admin_auth_forgot_password_button'] = 'Confirm';
$lang['task_assigned'] = 'Assigned to';
$lang['switch_to_pipeline'] = 'Switch to pipeline';
$lang['switch_to_list_view'] = 'Switch to list';
$lang['estimates_pipeline'] = 'Estimates Pipeline';
$lang['estimates_pipeline_sort'] = 'Sort By';
$lang['estimates_sort_expiry_date'] = 'Expiry Date';
$lang['estimates_sort_pipeline'] = 'Pipeline Order';
$lang['estimates_sort_datecreated'] = 'Date Created';
$lang['estimates_sort_estimate_date'] = 'Estimate Date';
$lang['estimate_set_reminder_title'] = 'Set Estimate Reminder';
$lang['invoice_set_reminder_title'] = 'Set Invoice Reminder';
$lang['estimate_reminders'] = 'Reminders';
$lang['invoice_reminders'] = 'Reminders';
$lang['estimate_notes'] = 'Notes';
$lang['estimate_add_note'] = 'Add Note';
$lang['dropdown_non_selected_tex'] = 'Nothing selected';
$lang['auto_close_ticket_after'] = 'Auto close ticket after (Hours)';
$lang['event_description'] = 'Description';
$lang['delete_event'] = 'Delete';
$lang['not_new_ticket_created'] = 'New ticket opened in your department - %s';
$lang['receive_notification_on_new_ticket'] = 'Receive notification on new ticket opened';
$lang['receive_notification_on_new_ticket_help'] = 'All staff members which belong to the ticket department will receive notification that new ticket is opened';
$lang['event_updated'] = 'Event updated successfuly';
$lang['customer_contacts'] = 'Contacts';
$lang['new_contact'] = 'New Contact';
$lang['contact'] = 'Contact';
$lang['contact_lowercase'] = 'contact';
$lang['contact_primary'] = 'Primary contact';
$lang['contact_position'] = 'Position';
$lang['contact_active'] = 'Active';
$lang['client_company_info'] = 'Company details';
$lang['proposal_save'] = 'Save Proposal';
$lang['calendar'] = 'Calendar';
$lang['settings_pdf'] = 'PDF';
$lang['settings_pdf_font'] = 'PDF Font';
$lang['settings_pdf_table_heading_color'] = 'Items table heading color';
$lang['settings_pdf_table_heading_text_color'] = 'Items table heading text color';
$lang['settings_pdf_font_size'] = 'Default font size';
$lang['proposal_status_draft'] = 'Draft';
$lang['custom_field_contacts'] = 'Contacts';
$lang['company_primary_email'] = 'Primary email';
$lang['client_register_contact_info'] = 'Primary Contact Information';
$lang['client_register_company_info'] = 'Company Informations';
$lang['contact_permissions_info'] = 'Make sure to set appropriate permissions for this contact';
$lang['defaut_leads_kanban_sort'] = 'Default leads Kan Ban Sort';
$lang['defaut_leads_kanban_sort_type'] = 'Sort';
$lang['order_ascending'] = 'Ascending';
$lang['order_descending'] = 'Descending';
$lang['calendar_expand'] = 'expand';
$lang['proposal_reminders'] = 'Reminders';
$lang['proposal_set_reminder_title'] = 'Set proposal reminder';
$lang['settings_allowed_upload_file_types'] = 'Allowed file types';
$lang['no_primary_contact'] = 'This customer dont have primary contact. You need to setup primary contact login as customer. Its recomended all customers to have primary contacts.';
$lang['leads_merge_customer'] = 'Customer fields merging';
$lang['leads_merge_contact'] = 'Contact fields merging';
$lang['leads_merge_as_contact_field'] = 'Merge as contact field';
$lang['lead_convert_to_client_phone'] = 'Phone';
$lang['invoice_status_report_all'] = 'All';
$lang['import_contact_field'] = 'Contact field';

$lang['file_uploaded_success'] = 'There is no error, the file uploaded with success';
$lang['file_exceds_max_filesize'] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
$lang['file_exceds_maxfile_size_in_form'] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
$lang['file_uploaded_partially'] = 'The uploaded file was only partially uploaded';
$lang['file_not_uploaded'] = 'No file was uploaded';
$lang['file_missing_temporary_folder'] = 'Missing a temporary folder';
$lang['file_failed_to_write_to_disk'] = 'Failed to write file to disk.';
$lang['file_php_extension_blocked'] = 'A PHP extension stopped the file upload.';
$lang['calendar_expand'] = 'Expand';
$lang['view_pdf'] = 'View PDF';
$lang['expense_repeat_every'] = 'Repeat every';

# Version 1.1.2
$lang['leads_switch_to_kanban'] = 'Switch to kan ban';
$lang['survey_no_questions'] = 'This survey does not have questions added yet.';
$lang['survey_submit'] = 'Submit';
$lang['contract_content'] = 'Contract';
$lang['contract_save'] = 'Save Contract';
$lang['contract_send_to_email'] = 'Send to email';
$lang['contract_send_to_client_modal_heading'] = 'Send contract to email';
$lang['contract_send_to'] = 'Send to';
$lang['contract_send_to_client_attach_pdf'] = 'Attach PDF';
$lang['contract_send_to_client_preview_template'] = 'Preview Email Template';
$lang['include_attachments_to_email'] = 'Include attachments to email';
$lang['contract_sent_to_client_success'] = 'The contract is successfully sent to the customer';
$lang['contract_sent_to_client_fail'] = 'Failed to send contract';

# Version 1.1.3
$lang['client_invalid_username_or_password'] = 'Invalid username or password';
$lang['client_old_password_incorect']     = 'Your old password is incorrect';
$lang['client_password_changed']          = 'Your password has been changed';
$lang['check_for_new_version']          = 'Check for new version';

# Version 1.1.4
$lang['total_leads_deleted'] = 'Total leads deleted: %s';
$lang['total_clients_deleted'] = 'Total customers deleted: %s';
$lang['confirm_action_prompt'] = 'Are you sure you want to perform this action?';
$lang['mass_delete'] = 'Mass Delete';
$lang['email_protocol'] = 'Email Protocol';
$lang['add_edit_members'] = 'Add/Edit Members';
$lang['project_overview_logged_hours'] = 'Logged Hours:';
$lang['project_overview_billable_hours'] = 'Billable Hours:';
$lang['project_overview_billed_hours'] = 'Billed Hours:';
$lang['project_overview_unbilled_hours'] = 'Unbilled Hours:';
$lang['calendar_first_day'] = 'First Day';
$lang['dt_mass_delete_help'] = 'Use the checkboxes on the right side for mass delete.';
$lang['permission_view'] = 'View';
$lang['permission_edit'] = 'Edit';
$lang['permission_create'] = 'Create';
$lang['permission_delete'] = 'Delete';
$lang['permission'] = 'Permission';
$lang['permissions'] = 'Permissions';
$lang['proposals_pipeline'] = 'Proposals Pipeline';
$lang['proposals_pipeline_sort'] = 'Sort By';
$lang['proposals_sort_open_till'] = 'Open Till';
$lang['proposals_sort_pipeline'] = 'Pipeline Order';
$lang['proposals_sort_datecreated'] = 'Date Created';
$lang['proposals_sort_proposal_date'] = 'Proposal Date';
$lang['is_not_staff_member'] = 'Not staff member';
$lang['lead_created'] = 'Created';
$lang['access_tickets_to_none_staff_members'] = 'Allow access to tickets for none staff members';
$lang['project_expenses'] = 'Expenses';
$lang['expense_currency'] = 'Currency';
$lang['currency_valid_code_help'] = 'Make sure to enter valid currency code.';
$lang['week'] = 'Week';
$lang['weeks'] = 'Weeks';
$lang['month'] = 'Month';
$lang['months'] = 'Months';
$lang['year'] = 'Year';
$lang['years'] = 'Years';
$lang['expense_report_category'] = 'Category';
$lang['expense_paid_via'] = 'Paid Via %s';
$lang['item_as_expense'] = '[Expense]';
$lang['show_help_on_setup_menu'] = 'Show help menu item on setup menu';
$lang['customers_summary_total'] = 'Total Customers';
$lang['filter_by'] = 'Filter by';
$lang['re_captcha'] = 'reCAPTCHA';
$lang['recaptcha_site_key'] = 'Site key';
$lang['recaptcha_secret_key'] = 'Secret key';
$lang['recaptcha_error'] = 'The reCAPTCHA field is telling that you are a robot.';
$lang['smtp_username'] = 'SMTP Username';
$lang['smtp_username_help'] = 'Fill only if your email client use username for SMTP login.';
$lang['pinned_project']= 'Pinned Project';
$lang['pin_project']= 'Pin Project';
$lang['unpin_project']= 'Unpin Project';
$lang['smtp_encryption']= 'Email Encryption';
$lang['smtp_encryption_none']= 'None';
$lang['show_proposals_on_calendar']= 'Proposals';
$lang['invoice_project_see_billed_expenses']= 'See expenses who wil be billed on this invoice';
$lang['recaptcha_help_settings']= 'If fields are not filled reCAPTCHA will not be used.';
$lang['project_overview_expenses'] = 'Total Expenses';
$lang['project_overview_expenses_billable'] = 'Billable Expenses';
$lang['project_overview_expenses_billed'] = 'Billed Expenses';
$lang['project_overview_expenses_unbilled'] = 'Unbilled Expenses';
$lang['announcement_date_list'] = 'Date';
$lang['project_setting_view_finance_overview'] = 'view finance overview';
$lang['show_all_tasks_for_project_member'] = 'Allow all staff to see all tasks related to projects (includes non-staff)';
$lang['not_staff_added_as_project_member'] = 'Added you as project member';
$lang['report_expenses_base_currency_select_explanation'] = 'You need to select currency becuase the system found different currencies used for expenses.';

# Version 1.1.6
$lang['project_activity_recorded_expense'] = 'Recorded Expense';
$lang['save_customer_and_add_contact'] = 'Save and create contact';
$lang['tickets_chart_weekly_opening_stats'] = 'Weekly Stats';
$lang['related_knowledgebase_articles'] = 'Related Articles';
$lang['detailed_overview'] = 'Tasks Overview';
$lang['tasks_total_checklists_finished'] = 'Total checklist items marked as finished';
$lang['tasks_total_added_attachments'] = 'Total attachments added';
$lang['tasks_total_comments'] = 'Total comments';
$lang['task_finished_on_time'] = 'Finished on time?';
$lang['task_finished_on_time_indicator'] = 'Yes';
$lang['task_not_finished_on_time_indicator'] = 'No';
$lang['task_filter_fetch_month_by'] = 'Fetch month from';
$lang['filter'] = 'Filter';
$lang['task_filter_detailed_all_months'] = 'All Months';
$lang['task_filter_detailed_show_tasks'] = 'Show Tasks';
$lang['kb_article_slug'] = 'Slug';


# Version 1.1.7
$lang['email_template_ticket_warning'] = 'If ticket is imported with email piping and the contact does not exists in the CRM the fields wont be replaced.';
$lang['auto_stop_tasks_timers_on_new_timer'] = 'Stop all other started timers when starting new timer';
$lang['notification_when_customer_pay_invoice'] = 'Receive notification when customer pay invoice (built-in)';
$lang['not_invoice_payment_recored'] = 'New invoice payment - %s';
$lang['email_template_contact_warning'] = 'If contact is not logged while making action the contact merge fields wont be replaced.';
$lang['theme_style'] = 'Theme Style';
$lang['change_role_permission_warning'] = 'Changing role permissions now wont affected current staff members permissions that are using this role.';
$lang['task_copied_successfuly'] = 'Task copied successfully';
$lang['failed_to_copy_task'] = 'Failed to copy task';
$lang['not_project_file_uploaded'] = 'New project file added';
$lang['settings_calendar_color'] = '%s Color';
$lang['settings_calendar_colors_heading'] = 'Styling';
$lang['reminder'] = 'Reminder';
$lang['back_to_tasks_list'] = 'Back to tasks list';
$lang['copy_task_confirm'] = 'Confirm';
$lang['changing_items_affect_warning'] = 'Changing item info wont affect on the created invoices/estimates.';
$lang['tax_is_used_in_expenses_warning'] = 'You cant update this tax because expenses transactions using this tax are found.';
$lang['note'] = 'Note';
$lang['leads_staff_report_converted'] = 'Total converted leads';
$lang['leads_staff_report_created'] = 'Total created leads';
$lang['leads_staff_report_lost'] = 'Total lost leads';
$lang['client_go_to_dashboard'] = 'Back to portal';
$lang['show_estimate_reminders_on_calendar'] = 'Estimate Reminders';
$lang['show_invoice_reminders_on_calendar'] = 'Invoice Reminders';
$lang['calendar_estimate_reminder'] = 'Estimate Reminder';
$lang['calendar_invoice_reminder'] = 'Invoice Reminder';
$lang['show_proposal_reminders_on_calendar'] = 'Proposal Reminders';
$lang['calendar_proposal_reminder'] = 'Proposal Reminder';
$lang['proposal_due_after']= 'Proposal Due After (days)';
$lang['project_progress']= 'Progress';
$lang['calculate_progress_through_tasks']= 'Calculate progress through tasks';
$lang['allow_customer_to_change_ticket_status']= 'Allow customer to change ticket status from customers area';
$lang['switch_to_general_report']= 'Switch to staff report';
$lang['switch_to_staff_report']= 'Switch to general report';
$lang['generate']= 'Generate';
$lang['from_date']= 'From date';
$lang['to_date']= 'To date';
$lang['not_results_found']= 'No results found';
$lang['lead_lock_after_convert_to_customer']= 'Dont allow editing the lead after converting to customer (admins not applied)';
$lang['default_pipeline_sort'] = 'Default pipeline sort';
$lang['not_goal_message_failed'] = 'We failed to achieve goal!<br /> Goal Type: %s
<br />Goal Achievement: %s
<br />Total Achivement: %s
<br />Start Date: %s
<br />End Date: %s';
$lang['toggle_full_view'] = 'Toggle full view';
$lang['not_estimate_invoice_deleted'] = 'deleted the created invoice';
$lang['not_task_new_comment'] = 'commented on task %s';
# Version 1.1.8
$lang['invoice_number_exists'] = 'This invoice number exists for the ongoing year.';
$lang['estimate_number_exists'] = 'This estimate number exists for the ongoing year.';
$lang['email_exists'] = 'Email already exists';
$lang['field_is_required'] = 'This field is required';
$lang['field_max_length'] = 'Please enter value no more than {0} characters';
$lang['not_uploaded_project_file'] = 'New file uploaded';
$lang['not_created_new_project_discussion'] = 'New project discussion created';
$lang['not_commented_on_project_discussion'] = 'New comment on project discussion';
$lang['all_staff_members'] = 'All staff members';
$lang['help_project_permissions'] = 'VIEW allows staff member to see ALL projects. If you only want them to see projects they are assigned (added as members), do not give VIEW permissions.';
$lang['help_tasks_permissions'] = 'VIEW allows staff member to see ALL tasks. If you only want them to see tasks they are assigned to or following, do not give VIEW permissions.';
$lang['expense_recuring_days'] = 'Day(s)';
$lang['expense_recuring_weeks'] = 'Week(s)';
$lang['expense_recuring_months'] = 'Month(s)';
$lang['expense_recuring_years'] = 'Years(s)';
$lang['reset_to_default_color'] = 'Reset to default color';
$lang['pdf_logo_width'] = 'Logo Width (PX)';
$lang['drop_files_here_to_upload'] = 'Drop files here to upload';
$lang['browser_not_support_drag_and_drop'] = 'Your browser does not support drag\'n\'drop file uploads';
$lang['remove_file'] = 'Remove file';
$lang['you_can_not_upload_any_more_files'] = 'You can not upload any more files';
$lang['custom_field_only_admin'] = 'Restrict visibility for administrators only';
$lang['leads_default_source'] = 'Default source';
$lang['clear_activity_log'] = 'Clear log';
$lang['default_contact_permissions'] = 'Default contact permissions';
$lang['invoice_activity_marked_as_cancelled'] = 'marked invoice as cancelled';
$lang['invoice_activity_unmarked_as_cancelled'] = 'unmarked invoice as cancelled';
$lang['wait_text'] = 'Please wait...';
$lang['projects_summary'] = 'Projects summary';
$lang['dept_imap_host'] = 'IMAP Host';
$lang['dept_encryption'] = 'Encryption';
$lang['dept_email_password'] = 'Password';
$lang['dept_email_no_encryption'] = 'No Encryption';
$lang['failed_to_decrypt_password'] = 'Failed to decrypt password';
$lang['delete_mail_after_import'] = 'Delete mail after import?';
$lang['expiry_reminder_enabled'] = 'Send expiration reminder';
$lang['send_expiry_reminder_before'] = 'Send expiration reminder before (DAYS)';
$lang['not_expiry_reminder_sent'] = 'Expiry reminder sent';
$lang['send_expiry_reminder'] = 'Sent expiration reminder';
$lang['sent_expiry_reminder_success'] = 'Expiration reminder successfuly sent';
$lang['sent_expiry_reminder_fail'] = 'Failed to send expiration reminder';
$lang['leads_default_status'] = 'Default status';
$lang['item_description_placeholder'] = 'Description';
$lang['item_long_description_placeholder'] = 'Long description';
$lang['item_quantity_placeholder'] = 'Quantity';
$lang['item_rate_placeholder'] = 'Rate';
$lang['tickets_summary'] = 'Tickets Summary';
$lang['tasks_list_priority'] = 'Priority';
$lang['ticket_status_db_2'] = 'In Progress';
$lang['ticket_status_db_1'] = 'Open';
$lang['ticket_status_db_3'] = 'Answered';
$lang['ticket_status_db_4'] = 'On Hold';
$lang['ticket_status_db_5'] = 'Closed';
$lang['ticket_priority_db_1'] = 'Low';
$lang['ticket_priority_db_2'] = 'Medium';
$lang['ticket_priority_db_3'] = 'High';
$lang['customer_have_projects_by'] = 'Contains projects by status %s';
$lang['customer_have_proposals_by'] = 'Contains proposals by status %s';
$lang['do_not_redirect_payment'] = 'Do not redirect me to the payment processor';
$lang['extension_not_allowed'] = 'Extension not allowed';
$lang['project_tickets'] = 'Tickets';
$lang['invoice_report'] = 'Invoice Report';
$lang['payment_modes_report'] = 'Payment Modes (Transactions)';
$lang['customer_admins'] = 'Customer Admins';
$lang['assign_admin'] = 'Assign admin';
$lang['customer_admin_date_assigned'] = 'Date Assigned';
$lang['customer_admin_login_as_client_message'] = 'Hello %s. You are added as admin to this customer. To see all customer data and adjust the portal login as customer.';
$lang['ticket_form_validation_file_size'] = 'File size must be less than %s';
$lang['has_transactions_currency_base_change'] = 'Changing the base currency is possible only if there are no transactions recorded in that currency. Delete the transactions to change the base currency';
$lang['customers_sort_all'] = 'All';

# Version 1.1.9
$lang['use_recaptcha_customers_area'] = 'Allow recaptcha on customers area (Login/Register)';
$lang['project_marked_as_finished'] = 'Project completed';
$lang['project_status_updated'] = 'Project status updated';
$lang['remove_decimals_on_zero'] = 'Remove decimals on numbers/money with zero decimals (2.00 will become 2, 2.25 will stay 2.25)';
$lang['remove_tax_name_from_item_table'] = 'Remove the tax name from item table row (Invoices/Estimates)';


# Version 1.2.0
$lang['not_billable_expenses_by_categories'] = 'Not billable expenses by categories';
$lang['billable_expenses_by_categories'] = 'Billable expenses by categories';
$lang['format_letter_size'] = 'Letter';
$lang['pdf_formats'] = 'Document formats';
$lang['swap_pdf_info'] = 'Swap Company/Customer Details (company details to right side, customer details to left side)';
$lang['invoice_estimate_pdf_text_color'] = 'Invoice/Estimate text color';
$lang['expenses_filter_by_categories'] = 'By Categories';
$lang['task_copy'] = 'Copy';
$lang['estimates_not_sent'] = 'Estimate Not Sent';
$lang['estimate_status'] = 'Status';
$lang['expenses_report_exclude_billable'] = 'Exclude Billable Expenses';
$lang['expenses_total'] = 'Total';
$lang['estimate_activity_added_attachment'] = 'Added attachment';
$lang['show_to_customer'] = 'Show to customer';
$lang['hide_from_customer'] = 'Hide from customer';
$lang['expenses_report_total'] = 'Total';
$lang['expenses_report'] = 'Expenses report';
$lang['expenses_report_tax'] = 'Tax';
$lang['expenses_report_total_tax'] = 'Total Tax';
$lang['expenses_detailed_report'] = 'Detailed Report';
$lang['expense_not_billable'] = 'Not Billable';
$lang['notification_settings'] = 'Notification settings';
$lang['staff_with_roles'] = 'Staff members with roles';
$lang['specific_staff_members'] = 'Specific Staff Members';
$lang['proposal_mark_as'] = 'Mark as %s';
$lang['kb_report_total_answers'] = 'Total';
$lang['ticket_message_edit'] = 'Edit';
$lang['invoice_files'] = 'Invoice Files';
$lang['estimate_files'] = 'Estimate Files';
$lang['proposal_files'] = 'Proposal Files';
$lang['invoices_awaiting_payment'] = 'Invoices Awaiting Payment';
$lang['tasks_not_finished'] = 'Tasks Not Finished';
$lang['outstanding_invoices'] = 'Outstanding Invoices';
$lang['past_due_invoices'] = 'Past Due Invoices';
$lang['paid_invoices'] = 'Paid Invoices';
$lang['invoice_estimate_year'] = 'Year';
$lang['no_results_text_search_dropdown'] = 'No Results Matched';
$lang['task_stats_logged_hours'] = 'Logged Hours';
$lang['leads_converted_to_client'] = 'Leads Converted to Customer';
$lang['current_version'] = 'Current Version: %s';
$lang['task_assigned_from'] = 'This task is assigned to you by %s';
$lang['auto_check_for_new_notifications'] = 'Auto check for new notifications (Seconds - Set 0 to disable)';
$lang['recurring_ends_on'] = 'Ends On (Leave blank for never)';
$lang['new_note'] = 'New Note';
$lang['my_tickets_assigned'] = 'Tickets assigned to me';
$lang['filter_by_assigned'] = 'By Assigned Member';
$lang['staff_stats_total_logged_time'] = 'Total Logged Time';
$lang['staff_stats_last_month_total_logged_time'] = 'Last Month Logged Time';
$lang['staff_stats_this_month_total_logged_time'] = 'This Month Logged Time';
$lang['staff_stats_last_week_total_logged_time'] = 'Last Week Logged Time';
$lang['staff_stats_this_week_total_logged_time'] = 'This Week Logged Time';
// Dont change this becuse are translated before for the projects timesheets and now are only used for readibility.
$lang['timesheet_user'] = $lang['project_timesheet_user'];
$lang['timesheet_start_time'] = $lang['project_timesheet_start_time'];
$lang['timesheet_end_time'] = $lang['project_timesheet_end_time'];
$lang['timesheet_time_spend'] = $lang['project_timesheet_time_spend'];
$lang['task_timesheets'] = $lang['project_timesheets'];
$lang['task_log_time_start'] = $lang['project_timesheet_start_time'];
$lang['task_log_time_end'] = $lang['project_timesheet_end_time'];
$lang['task_single_log_user'] = $lang['project_timesheet_user'];


// Ahmed Faiçal changes
$lang['customer_active']             = 'Active';
$lang['customer_mode_alami']             = 'Mode Alami';

$lang['staff_add_edit_alami_firstname']             = 'Firstname Alami';
$lang['staff_add_edit_alami_lastname']             = 'Lastname Alami';
$lang['staff_add_edit_alami_email']             = 'Email Alami';
$lang['contact_active_cc']             = 'Toujours en copie des emails system';
$lang['admin_home_slider_title']             = 'Sliders';
$lang['utilities_save_slider_order']             = "Enregistrer l'ordre";

$lang['login_as_admin'] = 'Afficher l\'espace admin' ;