import { Head, Link, usePage } from '@inertiajs/react';
import { ChevronLeft, ChevronRight, EllipsisVertical } from 'lucide-react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardHeader, CardTitle } from '@/components/ui/card';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    create as createRoute,
    destroy as destroyRoute,
    edit,
    index as indexRoute,
} from '@/routes/users';
import { router } from '@inertiajs/react';

interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    created_at: string;
}

interface PaginatedUsers {
    data: User[];
    meta: {
        current_page: number;
        last_page: number;
        total: number;
        from: number;
        to: number;
    };
}

export default function UsersIndex() {
    const { users } = usePage<{ users: PaginatedUsers }>().props;
    const [searchTerm, setSearchTerm] = useState('');

    const handleSearch = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearchTerm(e.target.value);
    };

    const handleSearchKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter' && searchTerm.trim()) {
            router.visit(indexRoute({ query: { search: searchTerm.trim() } }).url);
        }
    };

    const handleDelete = (userId: number) => {
        if (window.confirm('Are you sure you want to delete this user?')) {
            router.delete(destroyRoute({ user: userId }).url);
        }
    };

    return (
        <div className="mt-2">
            <Head title="Users" />
            <div className="pb-8">
                <div className="mb-6 flex flex-wrap items-center gap-4">
                    <h1 className="text-2xl font-bold">Users</h1>
                    <Link href={createRoute().url}>
                        <Button variant="outline">New User</Button>
                    </Link>
                </div>

                <div className="mb-4">
                    <Label htmlFor="search">Search users</Label>
                    <Input
                        id="search"
                        placeholder="Search by name or email..."
                        value={searchTerm}
                        onChange={handleSearch}
                        onKeyDown={handleSearchKeyDown}
                        className="w-full max-w-xs"
                    />
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Users List</CardTitle>
                    </CardHeader>
                    <div className="overflow-x-auto">
                        <table className="w-full text-sm">
                            <thead>
                                <tr className="border-b text-left">
                                    <th className="px-4 py-3 font-medium">
                                        ID
                                    </th>
                                    <th className="px-4 py-3 font-medium">
                                        Name
                                    </th>
                                    <th className="px-4 py-3 font-medium">
                                        Email
                                    </th>
                                    <th className="px-4 py-3 font-medium">
                                        Email Verified
                                    </th>
                                    <th className="px-4 py-3 font-medium">
                                        Created At
                                    </th>
                                    <th className="px-4 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {users.data.map((user) => (
                                    <tr
                                        key={user.id}
                                        className="border-b hover:bg-muted/50"
                                    >
                                        <td className="px-4 py-3">{user.id}</td>
                                        <td className="px-4 py-3">
                                            {user.name}
                                        </td>
                                        <td className="px-4 py-3">
                                            {user.email}
                                        </td>
                                        <td className="px-4 py-3">
                                            {user.email_verified_at ? (
                                                <span className="text-xs text-green-500">
                                                    Yes
                                                </span>
                                            ) : (
                                                <span className="text-xs text-gray-500">
                                                    No
                                                </span>
                                            )}
                                        </td>
                                        <td className="px-4 py-3">
                                            {user.created_at
                                                ? new Date(
                                                      user.created_at,
                                                  ).toLocaleDateString()
                                                : null}
                                        </td>
                                        <td className="px-4 py-3">
                                            <DropdownMenu>
                                                <DropdownMenuTrigger asChild>
                                                    <Button
                                                        size="icon"
                                                        variant="ghost"
                                                        className="h-8 w-8"
                                                    >
                                                        <EllipsisVertical className="h-4 w-4" />
                                                    </Button>
                                                </DropdownMenuTrigger>
                                                <DropdownMenuContent
                                                    align="end"
                                                    side="top"
                                                >
                                                    <DropdownMenuItem
                                                        onClick={() =>
                                                            router.visit(
                                                                edit({
                                                                    user: user.id,
                                                                }).url,
                                                            )
                                                        }
                                                    >
                                                        Edit
                                                    </DropdownMenuItem>
                                                    <DropdownMenuItem
                                                        onClick={() =>
                                                            handleDelete(
                                                                user.id,
                                                            )
                                                        }
                                                        className="text-destructive"
                                                    >
                                                        Delete
                                                    </DropdownMenuItem>
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    <div className="flex items-center justify-between px-4 py-3 text-sm">
                        <span className="text-muted-foreground">
                            Showing {users.meta.from} to {users.meta.to} of{' '}
                            {users.meta.total} users
                        </span>
                        <div className="flex space-x-2">
                            {users.meta.current_page > 1 && (
                                <Button
                                    size="icon"
                                    onClick={() =>
                                        router.visit(
                                            indexRoute({
                                                query: {
                                                    page:
                                                        users.meta
                                                            .current_page - 1,
                                                },
                                            }).url,
                                        )
                                    }
                                >
                                    <ChevronLeft className="h-4 w-4" />
                                </Button>
                            )}
                            {users.meta.current_page < users.meta.last_page && (
                                <Button
                                    size="icon"
                                    onClick={() =>
                                        router.visit(
                                            indexRoute({
                                                query: {
                                                    page:
                                                        users.meta
                                                            .current_page + 1,
                                                },
                                            }).url,
                                        )
                                    }
                                >
                                    <ChevronRight className="h-4 w-4" />
                                </Button>
                            )}
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    );
}
