import Calc from "@/components/Calculator/Calc.vue";

export let text = {
    bill:{
        greeting_phrase:'Sehr geehrte Damen und Herren, für die Leistungen am o. g. Projekt darf ich als Abschlag wie folgt in Rechnung stellen:',
    },
    menu:{
        Login: 'Login',
        Registration: 'Registrierung',
        Logout: 'Logout',
        Calculator: 'Calculator',
        Profile: 'Profile',
    },
    header:{
        Calculator: 'Calculator',
        Edit_HOAI_version: 'Edit HOAI version',
        Projects:'Projects',
        Neues_Projekt: 'Neues Projekt',
        Save: 'Einfamilienhaus',
        Open_unsaved_project: 'Nicht gespeichertes Projekt öffnen',
        Open_project:'Projekt öffnen',
        New_invoice:'Neues Rechnung',
        Invoice:'Rechnung',
    },
    footer:{
        Copyright:'Copyright © 2024 honorar.online',
        Privacy_Policy:'Impressum Datenschutz Cookie Einstellungen',
        mail:'mail@honorar.online',
    },
    pupaps:{
        Yes:'Ja',
        No:'Nein',
    },
    openProject:{
        loading:'Loading . . .',
        Select_Project: 'Select Project',
        No_selected_project:'Keine Projekte vorhanden',
        All_Projects:'All Projects',
        Recent:'Recent',
        Open: 'Open',
        Delete: 'Delete',
        Objects: 'Objects',
        Bils: 'Bils',
    },
    UserServis:{
        // Login
        Email: 'Email',
        Email_wrong: 'Keine gültige E-Mail',
        Password: 'Password',
        Fill_feld:'Feld ausfüllen',
        loading: 'Loading . . .',
        Not_found:'nicht gefunden',
        Submit:'Einreichen',
        Registration:'Registrierung',
        Forgot_password:'Passwort vergessen',

        // Registration (rest variables of above )
        Password_confom:'Passwort bestätigen',
        Contact_support:'Kontaktieren Sie den Support',
        Login: 'Login',
        Invalid_email_address:'Keine gültige E-Mail',
        Assign_email_address:"E-Mail vergeben",
        least_6_characters:"mindestens 6 Zeichen",

        //Reset password (rest variables of above )
        Code_at_Email:'Code aus Email',
        Code_wrong:'Ungültiger Code',
        New_password:'Neues Passwort',

        // Profile Page
        Profile:'Profile',
        felds:{
            name:'name:',
            email:'email:',
            phone: 'phone:',

            address: 'address:',
            IBAN:'IBAN:',
            BIC: 'BIC:',
            Institut:'Institut:',
            USt_Id_Nr:'USt - Id. - Nr.:',

            old_password:'old password:',
            new_password:'new password:',
            conform_password:'conform password:',
        },

        Passwords_not_same:'Passwort weicht ab',
        error: 'error',
        length_min_3:'mindestens 3 Buchstaben',
        error_Email: 'error Email',
        Email_used:'Beschäftigt Email',
        error_phone: 'error phone',

        Successful: 'Erfolgreich',
        fall:'fallen',
        Save:'Save',

        The_account_will_be_permanently_deleted:'Das Konto wird dauerhaft gelöscht. Möchten Sie es wirklich entfernen?',
    },
    Calc:{
        Honorarobjekt:'Honorarobjekt', //Button
        Loading:'Loading . . . ',
        Summe: 'Summe',
        Customer:'Customer:',
        Honorar_Base:'Honorargrundlagen',
        HOAI_Version:'HOAI Version',
        Paragraph:'Planungsgegenstand',
        Honorarzone:'Honorarzone',
        Honorarzone_detals:{
            points:'points',
            Summe:'Summe: ',
            corresponds_to_fee_zone:'corresponds to fee zone: ',
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
            Total_eligible_costs_other:'Summe eligible costs, "other": ',
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