tendooApp.factory( 'itemsTypes', function(){
    return [{
        namespace    :   'add.clothes',
        icon    :   'shirt',
        text    :   '<?php echo __( 'Vêtements & Accessoires', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Vendez des vêtements et accéssoires de mode.', 'nexopos_advanced' );?>',
        disableVariation   :   false
    },{
        namespace    :   'medecine',
        icon    :   'medicine',
        text    :   '<?php echo __( 'Comprimé & Accessoires', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Ce produit disposera des champs pour les produis des pharmacies.', 'nexopos_advanced' );?>',
        disableVariation   :   false
    },{
        namespace    :   'add.coupon',
        icon    :   'coupon',
        text    :   '<?php echo __( 'Coupon & Bon de commande', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Ce produit sera liée à un bon de commande existant.', 'nexopos_advanced' );?>',
        disableVariation   :   true
    },{
        namespace    :   'beer',
        icon    :   'alcoholic',
        text    :   '<?php echo __( 'Bière & Liqueurs', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Vous permettra de créer des produits pour un bar ou snack bar.', 'nexopos_advanced' );?>',
        disableVariation   :   false
    },{
        namespace    :   'food',
        icon    :   'turkey',
        text    :   '<?php echo __( 'Repas & Gateaux', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Vous permettra de manger de produits comestibles.', 'nexopos_advanced' );?>',
        disableVariation   :   false
    },{
        namespace    :   'service',
        icon    :   'customer-service',
        text    :   '<?php echo __( 'Service', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Vous pourrez créer un service vendable.', 'nexopos_advanced' );?>',
        disableVariation   :   true
    },{
        namespace    :   'digital',
        icon    :   'music-player',
        text    :   '<?php echo __( 'Digital', 'nexopos_advanced' );?>',
        desc    :   '<?php echo _s( 'Vous pourrez créer produit digital.', 'nexopos_advanced' );?>',
        disableVariation   :   false
    }];
})
