<?php

use yii\db\Migration;

/**
 * Class m240530_050342_create_base_tables
 */
class m240530_050342_create_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {



        //Tabla usuario 
        $this->createTable(
            '{{%usuario}}',
            [
                'id' => 'pk',
                'clave_empleado'=>$this->string(10),
                'nombre'=>$this->string(100),
                'apellido_paterno'=>$this->string(100),
                'apellido_materno'=>$this->string(100),
                'sueldo_mensual'=>$this->integer(11),
                'fecha_ingreso'=>$this->timestamp(),
                'fecha_baja'=>$this->timestamp(),
                'curp'=>$this->string(50),
                'rfc'=>$this->string(50),
                'papelera' => $this->tinyInteger(1),
                'activo' => $this->tinyInteger(1)
            ]
        );


        $this->createTable('{{%cuenta}}',
        
        ['id'=>'pk',
         'usuario_id'=>$this->integer(),
         'banco'=>$this->string(80),
         'no_cuenta'=>$this->string(30),
         'clave_interbancaria'=>$this->string(30),
         'tipo_cuenta'=>$this->string(20),
         'sucursal'=>$this->string(80),
         'fecha_registro'=>$this->timestamp(),
         'papelera'=>$this->tinyInteger(1),
         'activo'=>$this->tinyInteger(1)
    
        ]);

        //clave foranea de la tabla cuenta para la tabla usuario
        $this->createIndex('cuenta_usuario_idx','{{%cuenta}}','usuario_id');
        $this->addForeignKey('cuenta_usuario_fk','{{%cuenta}}','usuario_id','{{%usuario}}','id','CASCADE','CASCADE');


        //tabla pago

        $this->createTable('{{%pago}}',
        [
            'id'=>'pk',
            'usuario_id'=>$this->integer(),
            'cuenta_id'=>$this->integer(),
            'cantidad'=>$this->integer(10),
            'fecha_pago'=>$this->timestamp(),
            'tipopago_id'=>$this->integer()
        ]);

        //Tabla tipo pago
        $this->createTable('{{%tipopago}}',
        [
            'id'=>'pk',
            'nombre'=>$this->string(20),
            'papelera'=>$this->tinyInteger(1),
            'activo'=>$this->tinyInteger(1)

        ]);




        //clave foranea para la tabla usuario, tiene también la clave forarea al usuario por utilidad para uniones
        //en consultas
        $this->createIndex('pago_usuario_idx','{{%pago}}','usuario_id');
        $this->addForeignKey('pago_usuario_fk','{{%pago}}','usuario_id','{{%usuario}}','id','CASCADE','CASCADE');

        //clave foranea para cuenta
        $this->createIndex('pago_cuenta_idx','{{%pago}}','cuenta_id');
        $this->addForeignKey('pago_cuenta_fk','{{%pago}}','cuenta_id','{{%cuenta}}','id','CASCADE','CASCADE');


        //clave foranea para tipo de pago
        $this->createIndex('pago_tipopago_idx','{{%pago}}','tipopago_id');
        $this->addForeignKey('pago_tipopago_fk','{{%pago}}','tipopago_id','{{%tipopago}}','id','CASCADE','CASCADE');





    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        $this->dropForeignKey('cuenta_usuario_fk','{{%cuenta}}');
        $this->dropIndex('cuenta_usuario_idx','{{%cuenta}}');


        $this->dropForeignKey('pago_usuario_idx','{{%pago}}');
        $this->dropIndex('pago_usuario_fk','{{%pago}}');

        $this->dropForeignKey('pago_cuenta_idx','{{%cuenta}}');
        $this->dropIndex('pago_cuenta_fk','{{%cuenta}}');

        $this->dropForeignKey('pago_tipopago_idx','{{%tipopago}}');
        $this->dropIndex('pago_tipopago_fk','{{%tipopago}}');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240530_050342_create_base_tables cannot be reverted.\n";

        return false;
    }
    */
}
