import { User } from "./types";

export function can(user:User, permissions:string):boolean{
    return user.permissions.includes(permissions);
}

export function hasRole(user:User, role:string):boolean{
    return user.roles.includes(role);
}

