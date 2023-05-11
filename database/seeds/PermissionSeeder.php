<?php

use Illuminate\Database\Seeder;

use App\Models\Permissions\Group;
use App\Models\Permissions\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        $users = Group::firstOrCreate([
            'name' => 'Usuários'
        ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-view',
                'display_name' => 'Visualizar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-create',
                'display_name' => 'Adicionar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-edit',
                'display_name' => 'Editar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-delete',
                'display_name' => 'Deletar Usuários'
            ]);
  
  
        // Projetos
        $projects = Group::firstOrCreate([
            'name' => 'Projetos'
        ]);
  
            Permission::firstOrCreate([
                'group_id' => $projects->id,
                'name' => 'project-view',
                'display_name' => 'Visualizar Projetos'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $projects->id,
                'name' => 'project-create',
                'display_name' => 'Adicionar Projetos'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $projects->id,
                'name' => 'project-edit',
                'display_name' => 'Editar Projetos'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $projects->id,
                'name' => 'project-delete',
                'display_name' => 'Deletar Projetos'
            ]);
  
  
        // Tarefas
        $tasks = Group::firstOrCreate([
            'name' => 'Tarefas'
        ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-view',
                'display_name' => 'Visualizar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-create',
                'display_name' => 'Adicionar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-edit',
                'display_name' => 'Editar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-delete',
                'display_name' => 'Deletar Tarefas'
            ]);
    }
}
