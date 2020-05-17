 <td><?php echo ($user->adm) == "1" ? "Sim" : "Nao"; ?></td>
 <td><?php echo ($user->bloqueado) == "1" ? "Sim" : "Nao"; ?> </td>
 <td><a href="{{route('users.edit', ['user' => $user]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar Permissões</a></td></td> 