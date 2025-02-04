import Calc from "@/components/Calculator/Calc.vue";
import { newBill } from "./projectBill";

export let text = {
    added_group:{
        // from newDataProjects.js
        description_text_calc: "Honorare online ermitteln, einfach und kostenlos! Mit dem Honorar-Rechner von HONORAR.online. Beschreiben Sie in diesem Feld Ihr Projekt und kalkulieren Sie jetzt die Honorare dafür!",
        customer_field_company: 'Firma des Kunden',
        customer_field_firstname: 'Vorname',
        customer_field_lasttname: 'Nachname',
        customer_field_street: 'Straße und Hausnummer',
        customer_field_plz: 'PLZ und',
        customer_field_city: 'Stadt',
        // in Profile:
        firstname:'Firstname:',
        my_company_name: 'Firmenname',
        my_company_street: 'Adresszeile 1', // dont print if empty
        my_company_street2: 'Adresszeile 2', // dont print if empty
        my_company_plz: 'PLZ',
        my_company_city: 'Stadt',
    },

    
    bill:{
        greeting_phrase:'Sehr geehrte Damen und Herren, für die Leistungen am o. g. Projekt darf ich als Abschlag wie folgt in Rechnung stellen:',
    },
    menu:{
        Login: 'Log in',
        Registration: 'Registrierung',
        Edit_HOAI_version: 'Edit HOAI',
        Logout: 'Logout',
        Calculator: 'Zum Rechner', // Pop-Up too short
        Profile: 'Mein Profil',
    },
    sideBar:{
        Calc:'Rechner',
        NewCalc:'Neue Kalkulation',
        LastCalcs: 'Letzte Kalkulationen',
        OpenCalcs: 'Kalkulation öffnen',
        Offer: 'Angebot',
        NewOffer: 'Angebot aus aktueller Kalkulation',
        LastOffer: 'Letzte Angebot',
        OpenOffer: 'Angebot öffnen',
        Project: 'Projekte',
        Projects: 'Projekte:',
        NewProject: 'Neues Projekt',
        OfferAsProject: 'Projekt aus Angebot',
        OpenProject: 'Projekt öffnen',
        from_today: 'vom heute',
        from_yestoday: 'von gestern',
        from: 'vom',
        contract: 'Vertrag',
        newBill: 'Rechnug stellen',
        bills: 'Rechnungen',

    },
    header:{
        Login: 'Log in',
        Projects:'Projekte',
        Neues_Projekt: 'Neues Projekt',
        Save: 'Projekt speichern',
        Open_unsaved_project: 'Nicht gespeichertes Projekt öffnen',
        Open_project:'Projekt öffnen',
        New_invoice:'Neue Rechnung',
        Invoice:'Rechnung',
    },
    footer:{
        Copyright:'Copyright © 2025 honorar.online',
        Impressum:'Impressum',
        Datenschutz:'Datenschutz',
        Cookie_Einstellungen:'Cookie Einstellungen',
        Contact: 'Kontakt',
        Abaut:'Über HONORAR.online',
        Instructions:'Anleitung',
        HOAI:'HOAI',
        Calculate_the_fee_correctly:'Honorar richtig berechnen',
        Blog:'Blog',
    },
    pupaps:{
        Yes:'Ja',
        No:'Nein',
    },
    openProject:{
        loading:'Loading . . .',
        Select_Project: 'Projekt wählen',
        No_selected_project:'Keine Projekte vorhanden',
        All_Projects:'Alle Projekte',
        Recent:'Zuletzt geöffnet...',
        Open: 'Öffnen',
        Delete: 'Löschen',
        Objects: 'Objekte',
        Bils: 'Rechnungen',
    },
    UserServis:{
        // Login
        Email: 'E-Mail',
        Email_wrong: 'Keine gültige E-Mail',
        Password: 'Passwort',
        Fill_feld:'Feld erforderlich',
        loading: 'Loading . . .',
        Not_found:'Nutzer nicht vorhanden',
        Submit:'Anmelden',
        Registration:'Registrierung',
        Forgot_password:'Passwort vergessen',

        // Registration (rest variables of above )
        Password_confom:'Passwort bestätigen',
        Contact_support:'Support kontaktieren',
        Login: 'Log in',
        Invalid_email_address:'Keine gültige E-Mail',
        Assign_email_address:"Diese E-Mail ist bereits registriert",
        least_6_characters:"mindestens 6 Zeichen",

        //Reset password (rest variables of above )
        Code_at_Email:'Code aus Email',
        Code_wrong:'Code ungültig',
        New_password:'Neues Passwort',

        // Profile Page
        Profile:'Profil',
        felds:{
            name:'Nachname:',
            email:'E-Mail:',
            phone: 'Telefon:',

            address: 'Adresse:', // obsolete, look nogroup
            IBAN:'IBAN:',
            BIC: 'BIC:',
            Institut:'Bank:',
            USt_Id_Nr:'USt-ID:',

            old_password:'Altes Passwort:',
            new_password:'Neues Passwort:',
            conform_password:'Passwort bestätigen:',
        },

        Passwords_not_same:'Passwort weicht ab',
        error: 'error',
        length_min_3:'mindestens 3 Zeichen',
        error_Email: 'Error E-Mail',
        Email_used:'E-Mail bereits vergeben',
        error_phone: 'Error Telefonnummer',

        Successful: 'Erfolgreich',
        fall:'fallen',
        Save:'Speichern',

        The_account_will_be_permanently_deleted:'Das Konto wird dauerhaft gelöscht. Möchten Sie es wirklich entfernen?',
    },
    Calc:{
        description: 'Honorare online ermitteln, einfach und kostenlos! Mit dem Honorar-Rechner von HONORAR.online. Beschreiben Sie in diesem Feld Ihr Projekt und kalkulieren Sie jetzt die Honorare dafür!',
        Honorarobjekt:'Honorarobjekt', //Button
        Loading:'Loading . . . ',
        Summe: 'Summe',
        Customer:'Kunde:',
        Honorar_Base:'Honorargrundlagen',
        HOAI_Version:'HOAI Version',
        Paragraph:'Planungsgegenstand',
        Honorarzone:'Honorarzone',
        Honorarzone_detals:{
            points:'Punkte',
            Summe:'Summe: ',
            corresponds_to_fee_zone:'Entspricht Honorarzone: ',
        },
        Honorarsatz:'Honorarsatz',
        Finance:'Anrechenbare Kosten', min: 'min', max: 'max',
        Finance_detals:{
            Summe:'100-800 Summe',
            Low:'Hilfswert',
            High:'Anrechenbar',
            of_which_other_eligible_costs:'hiervon sonstige anrechenbare Kosten',
            costs_that_can_be_charged_as_a_result_of_this:'hiervon bedingt anrechenbare Kosten',
            hiervon_zu_100_anrechenbar:'hiervon zu 100% anrechenbar (über 25% von',
            hiervon_zu_50_anrechenbar:'hiervon zu 50% anrechenbar (über 25% von',
            total_non_allowable_costs:'Summe nicht anrechenbare Kosten',
            Total_eligible_costs_other:'Summe der "sonstigen" anrechenbaren Kosten: ',
        },
        Fee_according_to_fee_table:'Honorar nach Honorartafel',
        Honorar_detals:{
            Name:'Name',
            Honorar_min:'Honorar von',
            Honorar_max:'Honorar bis',
            Table_Value_Top:'Tabellenwert Oben',
            Interpolation:'Interpolation',
            Table_Value_Bottom:'Tabellenwert Unten',
        },
        Pay_extra:'Zuschlag',
        Base_servis:'Leistungen',
        Special_servis:'Besondere Leistungen',
        Enter_performance:'Leistung eingeben',
        Additional_services:'Zusätzliche Leistungen',
        Total_Additional_Services:'Summe Zusätzliche Leistungen',
        Extra_costs:'Nebenkosten',
        Total_Extra_costs:'Summe der Nebenkosten',
        Summary:'Zusammenfassung',
        Total_net:'Gesamtsumme Netto',
        Total_tax:'Umsatzsteuer',
        Total_gross: 'Gesamtsumme Brutto',
        Sum_summary:'Summe Zusammenfassung',
        Sum_total_calc:'Summe: ',
    }

}